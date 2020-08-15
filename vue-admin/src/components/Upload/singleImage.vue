<template>
  <div class="upload-container">
    <el-upload
      :show-file-list="true"
      :data="dataobj"
      :action="action"
      :headers="headers"
      :multiple="multiple"
      :name="fileName"
      :accept="accept"
      :drag="drag"
      :limit="limit"
      :file-list="fileList"
      :on-preview="handlePreview"
      :on-exceed="handleExceed"
      :before-upload="beforeUpload"
      :on-progress="onProgress"
      :on-success="handleSuccess"
      :on-error="handleError"
      :on-remove="handleRemove"
      class="image-uploader"
      list-type="picture-card"
    >
      <i class="el-icon-plus" />
    </el-upload>
  </div>
</template>

<script>
import openWindow from '@/utils/open-window'
export default {
  name: 'SingleImageUpload',
  props: {
    value: {
      type: String,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: ''
    },
    config: {
      type: Object,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: {
        fileName: 'img',
        limit: 1,
        multiple: false,
        accept: 'image/*',
        action: '',
        drag: false
      }
    },
    header: {
      type: Object,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: {
        'x-access-appid': '',
        'x-access-token': ''
      }
    }
  },
  data() {
    return {
      limit: 1,
      fileName: this.config.fileName,
      multiple: this.config.multiple,
      accept: this.config.accept,
      action: this.config.action,
      headers: this.header,
      drag: this.config.drag,
      dataobj: { filename: this.config.fileName }
    }
  },
  computed: {
    fileList() {
      const imgarr = []
      if (this.value === '') {
        return []
      }
      imgarr.push({ url: this.value })
      return imgarr
    }

  },
  methods: {
    emitInput(val) {
      this.$emit('input', val)
    },
    handleRemove(file, fileList) {
      if (fileList.length > 0) {
        this.emitInput(fileList[0]['url'])
      } else {
        this.emitInput('')
      }
    },
    handlePreview(file) {
      openWindow(file.url, '图片预览', '500', '400')
    },
    handleExceed(files, fileList) {
      this.$message.error('最多上传' + this.limit + '张图片')
    },
    beforeUpload(file) {
      const isIMG = file.type === 'image/jpeg' || file.type === 'image/png'
      const isLt5M = file.size / 1024 / 1024 < 5
      if (!isIMG) {
        this.$message.error('上传图片只能是 JPG、PNG 格式!')
        return false
      }
      if (!isLt5M) {
        this.$message.error('上传图片大小不能超过 5MB!')
        return false
      }
      return isIMG && isLt5M
    },
    onProgress(event, file, fileList) {
      console.log('========onProgress=========')
      console.log(event, file, fileList)
      console.log('========onProgress=========')
    },
    handleSuccess(res, file, fileList) {
      if (res.status === 1) {
        for (let i = 0; i < fileList.length; i++) {
          if (fileList[i]['uid'] === file['uid']) {
            fileList[i]['url'] = res.data.path
            break
          }
        }
        this.emitInput(fileList[0]['url'])
      } else {
        for (let i = 0; i < fileList.length; i++) {
          if (fileList[i]['uid'] === file['uid']) {
            fileList.splice(i, 1)
            break
          }
        }
        this.$message.error(res.msg)
      }
    },
    handleError(err, file, fileList) {
      this.$message.error(err)
    }

  }
}
</script>
<style rel="stylesheet/scss" lang="scss">
	.image-uploader {
    height: 80px;
    overflow: hidden;
		.el-upload {
			border: 1px dashed #d9d9d9;
			border-radius: 6px;
			cursor: pointer;
			position: relative;
			overflow: hidden;
			width: 80px;
			height: 80px;
			.el-upload-dragger{
				height: 100%;
			}
			&:hover{
				border-color: #409EFF;
			}
		}
		.el-upload-list__item{
			width: 80px;
			height: 80px;
		}
		.image {
			width: 80px;
			height: 80px;
			display: block;
		}
		.el-upload--picture-card {
			font-size: 28px;
			color: #8c939d;
			width: 80px;
			height: 80px;
      line-height:85px;
			text-align: center;
		}

	}
</style>
