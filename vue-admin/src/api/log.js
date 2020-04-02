import request from '@/utils/request'

export function getList(query) {
  return request({
    url: '/admin/log/index',
    method: 'post',
    data: query
  })
}

