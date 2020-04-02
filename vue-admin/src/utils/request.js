import axios from 'axios'
import { MessageBox, Message } from 'element-ui'
import store from '@/store'
import { getToken, getSignature } from '@/utils/auth'
import defaultSettings from '@/settings.js'
import qs from 'qs'

// create an axios instance
const service = axios.create({
  baseURL: process.env.VUE_APP_BASE_API, // url = base url + request url
  // withCredentials: true, // send cookies when cross-domain requests
  timeout: 5000 // request timeout
})

// 请求拦截器
service.interceptors.request.use(
  config => {
    // token
    config.headers['x-access-appid'] = defaultSettings.appid
    if (store.getters.token && store.getters.token != undefined) {
      config.headers['x-access-token'] = getToken()
    }
    // signature
    if (config.method === 'post') {
      config.data = getSignature(config.data)
      config.data = qs.stringify(config.data)
    } else if (config.method === 'get') {
      config.params = getSignature(config.params)
    }
    return config
  },
  error => {
    // do something with request error
    console.log(error) // for debug
    return Promise.reject(error)
  }
)

// 响应拦截器
service.interceptors.response.use(
  /**
   * If you want to get http information such as headers or status
   * Please return  response => response
  */
  response => {
    const res = response.data
    // 业务逻辑错误
    if (res.status !== 1) {
      // token 过期了
      if (res.code === 11102 || res.code === 11103) {
        // to re-login
        MessageBox.confirm('你已被登出，可以取消继续留在该页面，或者重新登录', '确定登出', {
          confirmButtonText: '重新登录',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          store.dispatch('user/resetToken').then(() => {
            location.reload()
          })
        })
      } else {
        Message({
          message: res.msg || 'Error',
          type: 'error',
          showClose: true,
          duration: 3 * 1000
        })
      }

      return Promise.reject(new Error(res.msg || 'Error'))
    } else {
      return res
    }
  },
  error => {
    console.log('err' + error) // for debug
    Message({
      message: error.message,
      type: 'error',
      showClose: true,
      duration: 3 * 1000
    })
    return Promise.reject(error)
  }
)

export default service
