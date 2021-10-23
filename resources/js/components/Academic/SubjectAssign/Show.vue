<template>
  <custom-card :title="$t('ShowSubjectAssign')" :url="'/subject-assign'" :text="$t('SubjectAssignList')">
    <div id="printAble">
      <div class="row">
        <div class="col-12">
          <div class="text-center">
            <h3>{{basic.name}}</h3>
            <h5>{{basic.address}}</h5>
            <h5>{{ $t('Phone') }}: {{basic.phone}}</h5>
            <span class="border rounded p-2">{{ $t('ShowSubjectAssign') }}</span>
          </div>
        </div>
        <div class="col-12 border-bottom">
          <div class="d-flex justify-content-between">
            <p>{{ $t('Custom') }}: {{assign.custom}}</p>
            <p>{{ $t('Date') }}: {{assign.updated_at|myDate}}</p>
          </div>
        </div>

        <div class="col-md-12">
          <table class="table table-bordered">

            <tr>
              <td>{{$t("Academic_Session") }}</td>
              <td>{{ assign.academic_session.duration }}</td>
            </tr>

            <tr>
              <td>{{$t("Academic_Class") }}</td>
              <td>{{ assign.academic_class.name }}</td>
            </tr>

            <template v-if="assign.type == 0">
              <tr>
                <td>{{$t("Section") }}</td>
                <td>{{ assign.section.name }}</td>
              </tr>
            </template>

            <template v-if="assign.type == 1">
              <tr>
                <td>{{$t("Academic_Group") }}</td>
                <td>{{ assign.group.name }}</td>
              </tr>
              <tr>
                <td>{{$t("Group_section") }}</td>
                <td>{{ assign.group_section.name }}</td>
              </tr>
            </template>

            <template v-if="assign.type == 2">
              <tr>
                <td>{{$t("Academic_Department") }}</td>
                <td>{{ assign.department.name }}</td>
              </tr>
              <tr>
                <td>{{$t("Department_year") }}</td>
                <td>{{ assign.year.name }}</td>
              </tr>
            </template>
          </table>
        </div>

        <div class="col-12">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td>Subject</td>
                <td>Teacher</td>
                <td>Day</td>
                <td>Period</td>
              </tr>
            </thead>
            <tr v-for="(list,i) in assign.lists" :key="i">
              <td>{{ list.academic_subject.name }}</td>
              <td>{{ list.teacher.name }} ({{ list.teacher.teacher.code }})</td>
              <td>{{ list.day.name }}</td>
              <td>{{ list.period.title }} ({{ list.period.show }})</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <button type="button" @click="printMe('printAble')" class="btn btn-success"><i class="fas fa-print"></i> {{ $t('Print') }}</button>
  </custom-card>
</template>

<script>
  export default {
    name: "Show",
    data() {
      return {
        basic: {},
        assign: {},
      }
    },
    methods: {
      async printMe(divName) {
        await this.$htmlToPaper(divName);
      },
      loadAssignDetails(custom) {
        axios.get(`/api/show-academic-class-subject-list/${custom}`).then((res) => {
          this.assign = res.data
        })
      }
    },
    created() {
      this.loadAssignDetails(this.$route.params.custom);
      this.basic = this.$store.getters.basicData;
    },
  }
</script>

<style lang="scss" scoped>
</style>
