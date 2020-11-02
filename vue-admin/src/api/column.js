import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/admin/articlecolumn/index',
    method: 'post',
    data: query
  })
}

export function getListAll() {
  return request({
    url: '/admin/articlecolumn/getlists',
    method: 'post'
  })
}

export function getinfo(id) {
  return request({
    url: '/admin/articlecolumn/getinfo',
    method: 'post',
    data: { id }
  })
}

export function save(data) {
  return request({
    url: '/admin/articlecolumn/save',
    method: 'post',
    data
  })
}

export function del(id) {
  return request({
    url: '/admin/articlecolumn/del',
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
    url: '/admin/articlecolumn/change',
    method: 'post',
    data
  })
}

export function delAll(data) {
  return request({
    url: '/admin/articlecolumn/delall',
    method: 'post',
    data
  })
}

export function changeAll(data) {
  return request({
    url: '/admin/articlecolumn/changeall',
    method: 'post',
    data
  })
}
