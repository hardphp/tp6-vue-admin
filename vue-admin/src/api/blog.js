import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/admin/article/index',
    method: 'post',
    data: query
  })
}

export function getListAll() {
  return request({
    url: '/admin/article/getlists',
    method: 'post'
  })
}

export function getinfo(id) {
  return request({
    url: '/admin/article/getinfo',
    method: 'post',
    data: { id }
  })
}

export function save(data) {
  return request({
    url: '/admin/article/save',
    method: 'post',
    data
  })
}

export function del(id) {
  return request({
    url: '/admin/article/del',
    method: 'post',
    data: { id }
  })
}

export function change(id, field, value) {
  const data = {
    val: id,
    field: field,
    value: value
  }
  return request({
    url: '/admin/article/change',
    method: 'post',
    data
  })
}

export function delAll(data) {
  return request({
    url: '/admin/article/delall',
    method: 'post',
    data
  })
}

export function changeAll(data) {
  return request({
    url: '/admin/article/changeall',
    method: 'post',
    data
  })
}
