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
            <el-form-item label="分类" prop="cate_id">
              <el-select v-model="temp.cate_id" class="filter-item" placeholder="请选择">
                <el-option v-for="item in cates" :key="item.id" :label="item.name" :value="item.id" />
              </el-select>
            </el-form-item>
            <el-form-item label="标题" prop="title">
              <el-input v-model="temp.title" clearable />
            </el-form-item>
            <el-form-item label="封面" prop="img">
              <Uploadone v-model="temp.img" :config="config" :header="header" />
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
          <el-tab-pane label="文章详情">
            <el-form-item label="详情" prop="content">
              <el-input v-model="temp.content" rows="20" type="textarea" clearable />
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
import Uploadone from '@/components/Upload/singleImage'
import { getListAll as getListAllCate } from '@/api/categery'
import { getinfo, save } from '@/api/blog'
import myconfig from '@/settings.js'
import { getToken } from '@/utils/auth'

export default {
  name: 'BlogForm',
  components: { Uploadone },
  data() {
    return {
      btnLoading: false,
      cates: null,
      temp: {
        id: 0,
        cate_id: '',
        title: '',
        content: '',
        status: 1,
        sorts: 100,
        img: ''
      },
      config: {
        fileName: 'img',
        limit: 1,
        multiple: true,
        accept: 'image/*',
        action: myconfig.uploadUrl.img
      },
      header: {
        'x-access-appid': myconfig.appid,
        'x-access-token': getToken()
      },
      dialogFormVisible: false,
      rules: {
        cate_id: [{ required: true, message: '分类必选', trigger: 'change' }],
        title: [{ required: true, message: '标题必填', trigger: 'blur' }],
        content: [{ required: true, message: '详情必填', trigger: 'blur' }]
      }

    }
  },
  computed: {
  },
  watch: {
    dialogFormVisible: function() {
      this.resetTemp()
    },
    temp: {
      // eslint-disable-next-line no-unused-vars
      handler(newVal, oldVal) {},
      immediate: true,
      deep: true
    }
  },
  created() {
    this.getCates()
  },
  destroyed() {

  },
  methods: {
    // eslint-disable-next-line no-unused-vars
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
    getCates() {
      getListAllCate().then(response => {
        this.cates = response.data.data
      })
    },
    resetTemp() {
      this.temp = {
        id: 0,
        cate_id: '',
        title: '',
        content: '',
        status: 1,
        sorts: 100,
        img: ''
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
          _this.temp.cate_id = response.data.cate_id
          _this.temp.title = response.data.title
          _this.temp.content = response.data.content
          _this.temp.status = response.data.status
          _this.temp.sorts = response.data.sorts
          _this.temp.img = response.data.img
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
    }
  }
}
</script>
