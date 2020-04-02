import { constantRoutes } from '@/router'

const state = {
  routes: [],
  addRoutes: []
}

const mutations = {
  SET_ROUTES: (state, routes) => {
    state.addRoutes = routes
    state.routes = constantRoutes.concat(routes)
  }
}

const actions = {
  generateRoutes({ commit }, data) {
    return new Promise(resolve => {
      const accessedRouters = data
      accessedRouters.map(function(item) {
        item.component = () => import('@/layout')
        item.children.map(function(child) {
          const child_component = child.component
          child.component = () => import(`@/views/${child_component}`)
        })
      })

      accessedRouters.push({ path: '*', redirect: '/404', hidden: true })
      commit('SET_ROUTES', accessedRouters)
      resolve(accessedRouters)
    })
  }
}

export default {
  namespaced: true,
  state,
  mutations,
  actions
}
