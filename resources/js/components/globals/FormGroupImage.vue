<template>
  <div class="form-group" :class="col">
    <label :for="name">{{label}}:</label>
    <div class="input-group image-preview">
      <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
      <div class="input-group-append">
        <!-- image-preview-clear button -->
        <button type="button" class="btn btn-outline-secondary image-preview-clear" @click="previewClear" style="display:none;">
          <i class="far fa-trash-alt"></i> Clear
        </button>
        <div class="btn btn btn-outline-secondary image-preview-input">
          <i class="far fa-folder-open"></i>
          <span class="image-preview-input-title">Browse</span>
          <input type="file" ref="fileInput" :name="name" @input="onSelectFile" /> <!-- rename it -->
        </div>
      </div>
    </div>
    <has-error :form="form" :field="name"></has-error>
  </div>
</template>

<script>
  import Swal from "sweetalert2";

  export default {
    name: "FormGroupImage",
    props: {
      value: {
        default: null,
      },
      name: {
        type: String,
        required: true,
      },
      label: {
        type: String,
        required: true,
      },
      form: {
        type: Object,
        required: true,
      },
      col: {
        type: String,
        default: null,
      },
      required: {
        required: false,
        type: Boolean,
        default: false,
      },
      readonly: {
        required: false,
        type: Boolean,
        default: false,
      },
      size: {
        required: false,
        default: 0,
      },
    },
    mounted() {
      $(document).on("click", "#close-preview", function () {
        $(".image-preview").popover("hide");
        // Hover before close the preview
        $(".image-preview").hover(
          function () {
            $(".image-preview").popover("show");
          },
          function () {
            $(".image-preview").popover("hide");
          }
        );
      });
      $(function () {
        $(".image-preview-filename").val("No file chosen");
        // Set the popover default content
        $(".image-preview").popover({
          trigger: "manual",
          html: true,
          title:
            'Preview <a href="#" id="close-preview" class="close" data-dismiss="alert">&times;</a>',
          content: "There's no image",
          placement: "bottom",
        });
      });
    },
    data() {
      return {
        setImage: null,
      };
    },
    methods: {
      onSelectFile(e) {
        var img = $("<img/>", {
          id: "dynamic",
          width: 250,
        });
        let file = e.target.files[0];
        let reader = new FileReader();
        if (this.size) {
          if (file["size"] < this.size * 1000) {
            reader.onloadend = (e) => {
              $(".image-preview-input-title").text("Change");
              $(".image-preview-clear").show();
              $(".image-preview-filename").val(file.name);
              img.attr("src", reader.result);
              $(".image-preview")
                .attr("data-content", $(img)[0].outerHTML)
                .popover("show");
              this.setImage = reader.result;
              this.$emit("input", reader.result);
            };
            reader.readAsDataURL(file);
          } else {
            Swal.fire({
              icon: "error",
              title: "Warning.!",
              text:
                "Please select a image which size less then " + this.size + "kb.",
            });
          }
        } else {
          reader.onloadend = (e) => {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr("src", reader.result);
            $(".image-preview")
              .attr("data-content", $(img)[0].outerHTML)
              .popover("show");
            this.setImage = reader.result;
            this.$emit("input", reader.result);
          };
          reader.readAsDataURL(file);
        }
      },
      previewClear() {
        $(".image-preview").attr("data-content", "").popover("hide");
        $(".image-preview-filename").val("No file chosen");
        $(".image-preview-clear").hide();
        $(".image-preview-input input:file").val("");
        $(".image-preview-input-title").text("Browse");
        this.setImage = "";
        this.$emit("input", "");
      },
    },
  };
</script>

<style scoped>
  .image-preview-input {
    position: relative;
    overflow: hidden;
    margin: 0;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
  }

  .image-preview-input input[type="file"] {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
  }

  .image-preview-input-title {
    margin-left: 2px;
  }
  .popover-body > img {
    width: 100% !important;
  }
</style>
