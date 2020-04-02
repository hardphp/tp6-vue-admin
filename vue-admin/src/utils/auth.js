import Cookies from 'js-cookie'
import { getEncrypt } from '@/utils/encrypt'
import defaultSettings from '@/settings.js'
const TokenKey = 'Admin-Token'

/**
 * 获取token
 */
export function getToken() {
  return Cookies.get(TokenKey)
}

/**
 * 设置token
 * @param {*} token
 */
export function setToken(token) {
  return Cookies.set(TokenKey, token, { expires: defaultSettings.cookieExpires })
}

/**
 * 删除token
 */
export function removeToken() {
  return Cookies.remove(TokenKey)
}

/**
 * 数据签名
 * @param {*} obj
 */
export function getSignature(obj) {
  let encrypt = {}
  if (obj) {
    encrypt = obj
  }
  // 签名
  const signature = getEncrypt(encrypt, defaultSettings.appSecret)
  encrypt.signature = signature
  return encrypt
}
