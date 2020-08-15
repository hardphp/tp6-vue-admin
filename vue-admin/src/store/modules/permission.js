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
        //一级菜单组件默认layout，数据库中组件字段无需配置
        item.component = (resolve) => require(['./../../layout'], resolve)
        if(item.children){
          item.children.map(function(child) {
            //二级菜单下如果无子菜单，数据库组件字段值=view下文件夹名称+'/'+vue文件名称，如果有三级菜单，二级菜单组件默认layout，数据库中组件字段无需配置
            const child_component = child.component
            if(child_component){
              child.component = (resolve) => require([`./../../views/${child_component}`], resolve)
            }else{
              child.component = (resolve) => require(['./../../layout'], resolve)
            }
            if(child.children){
              //最多三级级菜单，数据库组件字段值=view下一级文件夹名称+'/'+二级文件夹名称+'/'+vue文件名称
              child.children.map(function(children) {
                const children_component = children.component
                children.component = (resolve) => require([`./../../views/${children_component}`], resolve)
              })
            }  
          })
        }
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
