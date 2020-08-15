<template>
  <div class="app-container">
    <el-form ref="dataForm" :model="temp" label-position="left" label-width="70px" style="width: 50%; ">
      <el-form-item label="角色" prop="group_id">
        <el-input v-model="group" :disabled="true" />
      </el-form-item>
      <el-form-item label="账号" prop="username">
        <el-input v-model="name" :disabled="true" />
      </el-form-item>
      <el-form-item label="密码" prop="password">
        <el-input v-model="temp.password" clearable placeholder="不修改，则留空" />
      </el-form-item>
      <el-form-item label="头像" prop="img">
        <Uploadone v-model="temp.img" :config="config" :header="header" />
      </el-form-item>
      <el-form-item label="姓名" prop="realname">
        <el-input v-model="temp.realname" clearable />
      </el-form-item>
      <el-form-item label="手机" prop="phone">
        <el-input v-model="temp.phone" clearable />
      </el-form-item>
      <el-form-item label="邮箱" prop="email">
        <el-input v-model="temp.email" clearable />
      </el-form-item>
    </el-form>
    <el-button :loading="btnLoading" type="primary" @click="saveData()">保存</el-button>
  </div>
</template>

<script>
import Uploadone from '@/components/Upload/singleImage'
import { modify } from '@/api/user'
import { mapGetters } from 'vuex'
import store from '@/store'
import myconfig from '@/settings.js'
import { getToken } from '@/utils/auth'

export default {
  name: 'MyInfo',
  components: { Uploadone },
  data() {
    return {
      btnLoading: false,
      temp: {
        password: '',
        realname: store.getters.realname,
        phone: store.getters.phone,
        email: store.getters.email,
        img: store.getters.avatar
      },
      config: {
        fileName: 'img',
        multiple: true,
        accept: 'image/*',
        action: myconfig.uploadUrl.img
      },
      header: {
        'x-access-appid': myconfig.appid,
        'x-access-token': getToken()
      }

    }
  },
  computed: {
    ...mapGetters([
      'name',
      'group'
    ])
  },
  watch: {
    temp: {
      handler(newVal, oldVal) {},
      immediate: true,
      deep: true
    }
  },
  created() {

  },
  destroyed() {

  },
  methods: {
    saveData() {
      this.btnLoading = true
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          const _this = this
          modify(this.temp).then(response => {
            if (response.status === 1) {
              store.commit('SET_AVATAR', _this.temp.img)
              store.commit('SET_REALNAME', _this.temp.realname)
              store.commit('SET_PHONE', _this.temp.phone)
              store.commit('SET_EMAIL', _this.temp.email)
              _this.$message.success(response.msg)
            } else {
              _this.$message.error(response.msg)
            }
            _this.btnLoading = false
          // eslint-disable-next-line handle-callback-err
          }).catch((error) => {
            this.btnLoading = false
          })
        } else {
          this.btnLoading = false
        }
      })
    }
  }
}
</script>
