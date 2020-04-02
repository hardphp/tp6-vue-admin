
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
            <el-form-item label="名称" prop="title">
              <el-input v-model="temp.title" clearable />
            </el-form-item>
            <el-form-item label="状态">
              <el-radio-group v-model="temp.status">
                <el-radio :label="1">正常</el-radio>
                <el-radio :label="0">禁用</el-radio>
              </el-radio-group>
            </el-form-item>
            <el-form-item label="权限">
              <el-tree
                ref="tree"
                :data="getRulesList"
                :default-checked-keys="defaultChecked"
                :props="defaultProps"
                default-expand-all
                show-checkbox
                check-strictly
                node-key="id"
                @check="checkHandle"
              />
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
import { getListAll } from '@/api/rules'
import { getinfo, save } from '@/api/roles'
import treeUtil from '@/utils/tree'

export default {
  name: 'RolesForm',
  data() {
    return {
      btnLoading: false,
      ruleList: [],
      temp: {
        id: 0,
        title: '',
        status: 1,
        rules: ''
      },
      dialogFormVisible: false,
      rules: {
        title: [{ required: true, message: '名称必填', trigger: 'blur' }]
      },
      defaultChecked: [],
      defaultProps: {
        children: 'children',
        label: 'title'
      }

    }
  },
  computed: {
    getRulesList() {
      return treeUtil.listToTreeMulti(this.ruleList)
    }
  },
  watch: {
    dialogFormVisible: function() {
      this.resetTemp()
    }
  },
  created() {
    this.getRules()
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
    getRules() {
      getListAll().then(response => {
        this.ruleList = response.data.data
      })
    },
    resetTemp() {
      this.temp = {
        id: 0,
        title: '',
        status: 1,
        rules: ''
      }
    },
    checkHandle(data) {
      const halfCheckedKeys = this.$refs.tree.getHalfCheckedKeys().join(',')
      const checkedKeys = this.$refs.tree.getCheckedKeys().join(',')
      if (halfCheckedKeys.length && checkedKeys.length) {
        this.temp.rules = halfCheckedKeys + ',' + checkedKeys
      } else if (halfCheckedKeys.length && checkedKeys.length === 0) {
        this.temp.rules = halfCheckedKeys
      } else if (halfCheckedKeys.length === 0 && checkedKeys.length) {
        this.temp.rules = checkedKeys
      } else {
        this.temp.rules = ''
      }
    },
    handleCreate() {
      this.btnLoading = false
      this.dialogFormVisible = true
      this.currentIndex = -1
      if (this.$refs.tree) {
        this.$refs.tree.setCheckedKeys([])
      }
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    },
    handleUpdate(id) {
      this.btnLoading = false
      this.dialogFormVisible = true
      const _this = this
      getinfo(id).then(response => {
        if (response.status === 1) {
          _this.temp.id = response.data.id
          _this.temp.title = response.data.title
          _this.temp.status = response.data.status
          _this.temp.rules = response.data.rules
          this.$refs.tree.setCheckedKeys(_this.temp.rules.split(','))
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
                d.id = response.data.id
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
    }
  }
}
</script>
