import request from '@/utils/request'

export function captcha() {
  return request({
    url: '/captcha',
    method: 'get',
  })
}

export function login(data) {
  return request({
    url: '/admin/login/index',
    method: 'post',
    data
  })
}

export function getuser() {
  return request({
    url: '/admin/admin/getuser',
    method: 'post'
  })
}

export function getList(query) {
  return request({
    url: '/admin/admin/index',
    method: 'post',
    data: query
  })
}

export function getinfo(id) {
  return request({
    url: '/admin/admin/getinfo',
    method: 'post',
    data: { id }
  })
}

export function modify(data) {
  return request({
    url: '/admin/admin/modify',
    method: 'post',
    data
  })
}

export function save(data) {
  return request({
    url: '/admin/admin/save',
    method: 'post',
    data
  })
}

export function del(id) {
  return request({
    url: '/admin/admin/del',
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
    url: '/admin/admin/change',
    method: 'post',
    data
  })
}

export function delAll(data) {
  return request({
    url: '/admin/admin/delall',
    method: 'post',
    data
  })
}

export function changeAll(data) {
  return request({
    url: '/admin/admin/changeall',
    method: 'post',
    data
  })
}

