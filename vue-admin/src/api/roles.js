import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/admin/groups/index',
    method: 'post',
    data: query
  })
}

export function getListAll() {
  return request({
    url: '/admin/groups/getlists',
    method: 'post'
  })
}

export function getinfo(id) {
  return request({
    url: '/admin/groups/getinfo',
    method: 'post',
    data: { id }
  })
}

export function save(data) {
  return request({
    url: '/admin/groups/save',
    method: 'post',
    data
  })
}

export function del(id) {
  return request({
    url: '/admin/groups/del',
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
    url: '/admin/groups/change',
    method: 'post',
    data
  })
}
export function delAll(data) {
  return request({
    url: '/admin/groups/delall',
    method: 'post',
    data
  })
}

export function changeAll(data) {
  return request({
    url: '/admin/groups/changeall',
    method: 'post',
    data
  })
}
