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
            <el-form-item label="上级" label-width="100px" prop="pid">
              <el-cascader v-model="pid" :options="getColumnList" :props="props_pid" placeholder="请选择" change-on-select @change="handleChange" />
            </el-form-item>
            <el-form-item label="栏目名称" label-width="100px" prop="name">
              <el-input v-model="temp.name" clearable />
            </el-form-item>
            <el-form-item label="seo关键词" label-width="100px" prop="seo_title">
              <el-input v-model="temp.seo_title" clearable />
            </el-form-item>
            <el-form-item label="seo描述" label-width="100px" prop="seo_dec">
              <el-input v-model="temp.seo_dec" type="textarea" clearable />
            </el-form-item>
            <el-form-item label="排序" label-width="100px" prop="sorts">
              <el-input v-model="temp.sorts" clearable />
            </el-form-item>
            <el-form-item label="状态" label-width="100px">
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
import { getinfo, save } from '@/api/column'
import tree from '@/utils/tree'
export default {
  name: 'ColumnForm',
  components: {},
  props: {
    columnList: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      btnLoading: false,
      columnTop: [{ 'id': 0, 'name': '顶级' }],
      pid: [],
      props_pid: { 'label': 'name', 'value': 'id' },
      temp: {
        id: 0,
        pid: 0,
        seo_title: '',
        name: '',
        status: 1,
        seo_dec: '',
        sorts: 100
      },
      dialogFormVisible: false,
      rules: {
        name: [{ required: true, message: '名称必填', trigger: 'blur' }]
      }
    }
  },
  computed: {
    getColumnList() {
      return this.columnTop.concat(tree.listToTreeMulti(this.columnList))
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
        seo_title: '',
        name: '',
        status: 1,
        seo_dec: '',
        sorts: 100
      }
    },
    handleCreate() {
      this.dialogFormVisible = true
      this.btnLoading = false
      this.currentIndex = -1
      this.pid = []
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
          _this.temp.pid = response.data.pid
          _this.temp.seo_title = response.data.seo_title
          _this.temp.name = response.data.name
          _this.temp.status = response.data.status
          _this.temp.seo_dec = response.data.seo_dec
          _this.temp.sorts = response.data.sorts
          _this.pid = tree.getParentsId(this.columnList, id)
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
