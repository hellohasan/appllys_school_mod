<template>
  <Fragment>
    <li v-role="['Super Admin','Admin','Register']" class="nav-header">Register Section</li>
    <li v-role="['Super Admin','Admin','Register']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-book"></i>
        <p>{{ $t('Manage_Academic') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <router-link to="/academic-session" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Academic_Session') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/academic-class" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Academic_Class') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/academic-group" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Academic_Group') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/academic-department" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Academic_Department') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/academic-section" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Group_section') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/academic-year" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Department_year') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/academic-grading" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Academic_Grading') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/class-periods" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('ClassPeriod') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Register']" class="nav-item has-treeview">
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-book purple"></i>
        <p>{{ $t('Academic_subject') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <router-link to="/academic-subject/add" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Create_subject') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/academic-subject" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Subject_list') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Register']" class="nav-item has-treeview">
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-graduation-cap purple"></i>
        <p>{{ $t('TeacherSubject') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <router-link to="/subject-assign/new" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewSubjectAssign') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/subject-assign" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('SubjectAssignList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Register']" class="nav-item has-treeview">
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-graduation-cap purple"></i>
        <p>{{ $t('Academic_teacher') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">

        <li class="nav-item">
          <router-link to="/teachers/add" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Create_teacher') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/teachers" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Teacher_list') }}</p>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link to="/designations" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Designation') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Register']" class="nav-item has-treeview">
      <a href="" class="nav-link">
        <i class="nav-icon fas fa-book purple"></i>
        <p>{{ $t('Manage_admission') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <router-link to="/admissions/add" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('New_admission') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admissions" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('Admission_list') }}</p>
          </router-link>
        </li>
      </ul>
    </li>
  </Fragment>
</template>

<script>
  import role from '../../directive/role/index'
  import { Fragment } from 'vue-fragment'

  export default {
    name: "Register",
    directives: { role },
    components: { Fragment },
  }
</script>

<style scoped>
</style>
