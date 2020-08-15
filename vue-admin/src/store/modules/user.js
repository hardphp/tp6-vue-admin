import { login, getuser } from '@/api/user'
import { getToken, setToken, removeToken } from '@/utils/auth'
import router, { resetRouter } from '@/router'

const state = {
  token: getToken(),
  name: '',
  avatar: '',
  status: '',
  realname: '',
  phone: '',
  email: '',
  roles: 0,
  group: ''
}

const mutations = {
  SET_TOKEN: (state, token) => {
    state.token = token
  },
  SET_NAME: (state, name) => {
    state.name = name
  },
  SET_AVATAR: (state, avatar) => {
    state.avatar = avatar
  },
  SET_ROLES: (state, roles) => {
    state.roles = roles
  },
  SET_REALNAME: (state, realname) => {
    state.realname = realname
  },
  SET_EMAIL: (state, email) => {
    state.email = email
  },
  SET_PHONE: (state, phone) => {
    state.phone = phone
  },
  SET_STATUS: (state, status) => {
    state.status = status
  },
  SET_GROUP: (state, group) => {
    state.group = group
  }

}

const actions = {
  // 登录
  login({ commit }, userInfo) {
    const { username, password ,code,key} = userInfo
    return new Promise((resolve, reject) => {
      login({ username: username.trim(), password: password,code:code,key:key }).then(response => {
        const { data } = response
        commit('SET_TOKEN', data.user_token)
        setToken(data.user_token)
        resolve()
      }).catch(error => {
        reject(error)
      })
    })
  },

  // 获取用户信息
  getUser({ commit, state }) {
    return new Promise((resolve, reject) => {
      getuser().then(response => {
        const data = response.data
        if (data.access && data.group_id > 0) {
          commit('SET_ROLES', data.group_id)
        } else {
          reject('拉取用户权限失败')
        }
        commit('SET_NAME', data.username)
        commit('SET_AVATAR', data.img)
        commit('SET_REALNAME', data.realname)
        commit('SET_PHONE', data.phone)
        commit('SET_EMAIL', data.email)
        commit('SET_GROUP', data.group)
        resolve(data)
      }).catch(error => {
        reject(error)
      })
    })
  },

  // 退出
  logout({ commit, state, dispatch }) {
    return new Promise((resolve, reject) => {
      commit('SET_TOKEN', '')
      commit('SET_ROLES', 0)
      removeToken()
      resetRouter()

      // reset visited views and cached views
      // to fixed https://github.com/PanJiaChen/vue-element-admin/issues/2485
      dispatch('tagsView/delAllViews', null, { root: true })

      resolve()
    })
  },

  // 删除token
  resetToken({ commit }) {
    return new Promise(resolve => {
      commit('SET_TOKEN', '')
      commit('SET_ROLES', 0)
      removeToken()
      resolve()
    })
  },

  // dynamically modify permissions
  changeRoles({ commit, state, dispatch }) {
    return new Promise(async resolve => {
      const { access } = await dispatch('getUser', state.token)

      resetRouter()

      // generate accessible routes map
      const accessRoutes = await dispatch('permission/generateRoutes', access, { root: true })

      // dynamically add accessible routes
      router.addRoutes(accessRoutes)

      // reset visited views and cached views
      dispatch('tagsView/delAllViews', null, { root: true })

      resolve()
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
