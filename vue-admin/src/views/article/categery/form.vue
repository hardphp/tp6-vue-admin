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
            <el-form-item label="栏目" prop="column_id">
              <el-cascader v-model="column_id" :options="getColumnList" :props="props_pid" placeholder="请选择" change-on-select @change="handleChange" />
            </el-form-item>
            <el-form-item label="名称" prop="name">
              <el-input v-model="temp.name" clearable />
            </el-form-item>
            <el-form-item label="详情" prop="content">
              <el-input v-model="temp.content" type="textarea" clearable />
            </el-form-item>
            <el-form-item label="排序" prop="sorts">
              <el-input v-model="temp.sorts" clearable />
            </el-form-item>
            <el-form-item label="状态">
              <el-radio-group v-model="temp.status">
                <el-radio :label="1">正常</el-radio>
                <el-radio :label="0">禁用</el-radio>
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
import { getListAll } from '@/api/column'
import { getinfo, save } from '@/api/categery'
import tree from '@/utils/tree'
export default {
  name: 'CategeryForm',
  components: { },
  data() {
    return {
      btnLoading: false,
      columns: null,
      column_id: [],
      props_pid: { 'label': 'name', 'value': 'id' },
      temp: {
        id: 0,
        column_id: 0,
        name: '',
        content: '',
        status: 1,
        sorts: 100
      },
      dialogFormVisible: false,
      rules: {
        column_id: [{ required: true, message: '栏目必选', trigger: 'change' }],
        name: [{ required: true, message: '名称必填', trigger: 'blur' }]
      }

    }
  },
  computed: {
    getColumnList() {
      if (this.columns) {
        return tree.listToTreeMulti(this.columns)
      } else {
        return null
      }
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
    this.getColumns()
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
    getColumns() {
      getListAll().then(response => {
        this.columns = response.data.data
      })
    },
    resetTemp() {
      this.temp = {
        id: 0,
        column_id: 0,
        name: '',
        content: '',
        status: 1,
        sorts: 100
      }
    },
    handleCreate() {
      this.dialogFormVisible = true
      this.btnLoading = false
      this.currentIndex = -1
      this.$nextTick(() => {
        this.$refs['dataForm'].clearValidate()
      })
    },
    handleUpdate(id) {
      this.dialogFormVisible = true
      this.btnLoading = false
      const _this = this
      getinfo(id).then(response => {
        if (response.status === 1) {
          _this.temp.id = response.data.id
          _this.temp.column_id = response.data.column_id
          _this.temp.name = response.data.name
          _this.temp.content = response.data.content
          _this.temp.status = response.data.status
          _this.column_id = tree.getParentsId(this.columns, response.data.column_id)
          _this.column_id.push(response.data.column_id)
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
          save(this.temp).then(response => {
            if (response.status === 1) {
              if (!_this.temp.id) {
                _this.temp.id = response.data.id
              }
              this.$emit('updateRow', _this.temp)
              _this.dialogFormVisible = false
              _this.$message.success(response.msg)
            } else {
              _this.$message.error(response.msg)
            }
            _this.btnLoading = false
          }).catch((error) => {
            _this.$message.error(error)
            this.btnLoading = false
          })
        } else {
          this.btnLoading = false
        }
      })
    },
    handleChange(value) {
      if (value.length) {
        this.temp.column_id = value[value.length - 1]
      }
    }
  }
}
</script>
