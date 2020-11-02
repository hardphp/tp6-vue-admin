import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/admin/articlecategery/index',
    method: 'post',
    data: query
  })
}

export function getListAll() {
  return request({
    url: '/admin/articlecategery/getlists',
    method: 'post'
  })
}

export function getinfo(id) {
  return request({
    url: '/admin/articlecategery/getinfo',
    method: 'post',
    data: { id }
  })
}

export function save(data) {
  return request({
    url: '/admin/articlecategery/save',
    method: 'post',
    data
  })
}

export function del(id) {
  return request({
    url: '/admin/articlecategery/del',
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
    url: '/admin/articlecategery/change',
    method: 'post',
    data
  })
}

export function delAll(data) {
  return request({
    url: '/admin/articlecategery/delall',
    method: 'post',
    data
  })
}

export function changeAll(data) {
  return request({
    url: '/admin/articlecategery/changeall',
    method: 'post',
    data
  })
}
