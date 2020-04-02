import crypto from 'crypto'
import qs from 'qs'

/**
 * 数据加密
 * @param {*} obj 加密对象
 * @param {*} signKey 加密盐值
 */
export function getEncrypt(obj, signKey) {
  const arr = []
  const keys = []
  for (const i in obj) {
    if (typeof obj[i] !== 'object' && i !== 'signature') {
      keys.push(i)
    }
  }
  keys.sort()
  for (const i in keys) {
    arr[keys[i]] = obj[keys[i]]
  }
  const arr_str = qs.stringify(arr)
  let arr_sha1 = crypto.createHash('sha1').update(arr_str).digest('hex')
  arr_sha1 = arr_sha1 + signKey
  return crypto.createHash('md5').update(arr_sha1).digest('hex')
}
