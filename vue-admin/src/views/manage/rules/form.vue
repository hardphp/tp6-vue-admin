<template>
  <el-drawer
    ref="drawer"
    :with-header="false"
    size="50%"
    :before-close="handleClose"
    :visible.sync="dialogFormVisible"
    direction="rtl"
    custom-class="demo-drawer"
  >
    <div class="demo-drawer__content">
      <el-form ref="dataForm" :rules="rules" :model="temp" label-position="left" label-width="70px" style="width: 100%; padding:10px; height: 100vh;overflow-y: scroll;">

        <el-tabs tab-position="top" style="height: 200px;">
          <el-tab-pane label="基本信息">
            <el-form-item label="上级" prop="pid">
              <el-cascader v-model="pid" :options="getRulesList" :props="props_pid"  filterable=true placeholder="请选择" change-on-select @change="handleChange" />
            </el-form-item>
            <el-form-item label="名称" prop="title">
              <el-input v-model="temp.title" clearable />
            </el-form-item>
            <el-form-item label="标识" prop="name">
              <el-input v-model="temp.name" clearable />
            </el-form-item>
            <el-form-item label="图标" prop="icon">
              <el-input v-model="temp.icon" clearable />
            </el-form-item>
            <el-form-item label="路径" prop="path">
              <el-input v-model="temp.path" clearable />
            </el-form-item>
            <el-form-item label="组件" prop="component">
              <el-input v-model="temp.component" clearable />
            </el-form-item>
            <el-form-item label="跳转" prop="redirect">
              <el-input v-model="temp.redirect" clearable />
            </el-form-item>
            <el-form-item label="状态">
              <el-radio-group v-model="temp.status">
                <el-radio :label="1">正常</el-radio>
                <el-radio :label="0">禁用</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="隐藏">
              <el-radio-group v-model="temp.hidden">
                <el-radio :label="1">是</el-radio>
                <el-radio :label="0">否</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="缓存">
              <el-radio-group v-model="temp.no_cache">
                <el-radio :label="0">是</el-radio>
                <el-radio :label="1">否</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="根路由">
              <el-radio-group v-model="temp.always_show">
                <el-radio :label="1">是</el-radio>
                <el-radio :label="0">否</el-radio>
              </el-radio-group>
            </el-form-item>
          </el-tab-pane>
        </el-tabs>

      </el-form>
      <div class="demo-drawer__footer" style="position:fixed;top:15px;right:30px;">
        <el-button size="mini" @click="$refs.drawer.closeDrawer()">取 消</el-button>
        <el-button size="mini" :loading="btnLoading" type="primary" @click="saveData()">保存</el-button>
      </div>
    </div>
  </el-drawer>
</template>

<script>
import { getinfo, save } from '@/api/rules'
import tree from '@/utils/tree'
export default {
  name: 'RulesForm',
  components: {},
  props: {
    ruleList: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      btnLoading: false,
      ruleTop: [{ 'id': 0, 'title': '顶级' }],
      pid: [],
      props_pid: { 'label': 'title', 'value': 'id' },
      temp: {
        id: 0,
        pid: 0,
        title: '',
        name: '',
        status: 1,
        icon: '',
        path: '',
        component: 'layout',
        hidden: 0,
        no_cache: 1,
        always_show: 1,
        redirect: 'noredirect'
      },
      dialogFormVisible: false,
      rules: {
        title: [{ required: true, message: '名称必填', trigger: 'blur' }],
        name: [{ required: true, message: '标识必填', trigger: 'blur' }],
        icon: [{ required: true, message: '图标必填', trigger: 'blur' }],
        path: [{ required: true, message: '路径必填', trigger: 'blur' }],
        component: [{ required: true, message: '组件必填', trigger: 'blur' }]
      }
    }
  },
  computed: {
    getRulesList() {
      return this.ruleTop.concat(tree.listToTreeMulti(this.ruleList))
    }
  },
  watch: {
    dialogFormVisible: function() {
      this.resetTemp()
    },
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
    handleClose(done) {
      if (this.btnLoading) {
        return
      }
      this.$confirm('更改将不会被保存，确定要取消吗？')
        .then(_ => {
          this.dialogFormVisible = false
        })
        .catch(_ => {})
    },
    resetTemp() {
      this.temp = {
        id: 0,
        pid: 0,
        title: '',
        name: '',
        status: 1,
        icon: '',
        path: '',
        component: 'layout',
        hidden: 0,
        no_cache: 1,
        always_show: 1,
        redirect: 'noredirect'
      }
    },
    handleCreate() {
      this.dialogStatus = 'create'
      this.dialogFormVisible = true
      this.currentIndex = -1
      this.pid = []
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    },
    handleUpdate(id) {
      this.dialogStatus = 'update'
      this.dialogFormVisible = true
      const _this = this
      getinfo(id).then(response => {
        if (response.status === 1) {
          _this.temp.id = response.data.id
          _this.temp.pid = response.data.pid
          _this.temp.title = response.data.title
          _this.temp.name = response.data.name
          _this.temp.status = response.data.status
          _this.temp.icon = response.data.icon
          _this.temp.path = response.data.path
          _this.temp.component = response.data.component
          _this.temp.hidden = response.data.hidden
          _this.temp.no_cache = response.data.no_cache
          _this.temp.always_show = response.data.always_show
          _this.temp.redirect = response.data.redirect
          _this.pid = tree.getParentsId(_this.ruleList, id)
          console.log(_this.ruleList)
          console.log(_this.pid)
          console.log('===============')
        }
      })
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    },
    saveData() {
      this.btnLoading = true
      this.$refs['dataForm'].validate((valid) => {
        if (valid) {
          const _this = this
          const d = this.temp
          save(d).then(response => {
            if (response.status === 1) {
              if (!d.id) {
                d.id2 = response.data.id
              }
              this.$emit('updateRow', d)
              _this.dialogFormVisible = false
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
    },
    handleChange(value) {
      if (value.length) {
        this.temp.pid = value[value.length - 1]
      }
    }
  }
}
</script>
