<template>
  <Fragment>
    <li v-role="['Super Admin','Admin','Accountant']" class="nav-header">{{ $t('AccountantSection') }}</li>

    <li v-role="['Super Admin','Admin','Accountant']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>{{ $t('BillAssign') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <router-link to="/bill-assigns/add" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewAssign') }}</p>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/bill-assigns" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('AssignList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" v-permission="['bill-receive-new','bill-receive-list']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>{{ $t('BillReceive') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li v-permission="['bill-receive-new']" class="nav-item">
          <router-link to="/bill-receive/new" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewReceive') }}</p>
          </router-link>
        </li>
        <li v-permission="['bill-receive-list']" class="nav-item">
          <router-link to="/bill-receive" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('ReceiveList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" v-permission="['expenses','expenses-create']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>{{ $t('AcademicExpense') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li v-permission="['expenses-create']" class="nav-item">
          <router-link to="/expenses/create" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewExpense') }}</p>
          </router-link>
        </li>
        <li v-permission="['expenses']" class="nav-item">
          <router-link to="/expenses" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('ExpenseList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" v-permission="['salary','salary-create']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>{{ $t('AcademicSalary') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li v-permission="['salary-create']" class="nav-item">
          <router-link to="/salary/create" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewSalary') }}</p>
          </router-link>
        </li>
        <li v-permission="['salary']" class="nav-item">
          <router-link to="/salary" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('SalaryList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" v-permission="['balance-transfer','balance-transfer-create']" class="nav-item has-treeview">
      <a href="#!" class="nav-link">
        <i class="nav-icon fas fa-file-invoice"></i>
        <p>{{ $t('BalanceTransfer') }}<i class="fas fa-angle-left right"></i></p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li v-permission="['balance-transfer-create']" class="nav-item">
          <router-link to="/balance-transfer/create" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('NewBalanceTransfer') }}</p>
          </router-link>
        </li>
        <li v-permission="['balance-transfer']" class="nav-item">
          <router-link to="/balance-transfer" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>{{ $t('BalanceTransferList') }}</p>
          </router-link>
        </li>
      </ul>
    </li>

    <li v-permission="['transaction-logs']" class="nav-item">
      <router-link to="/transaction-logs" class="nav-link">
        <i class="nav-icon fas fa-receipt cyan"></i>
        <p>{{ $t('TransactionLog') }}</p>
      </router-link>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" class="nav-item">
      <router-link to="/bill-items" class="nav-link">
        <i class="nav-icon fas fa-receipt cyan"></i>
        <p>{{ $t('BillItem') }}</p>
      </router-link>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" class="nav-item">
      <router-link to="/salary-scale" class="nav-link">
        <i class="nav-icon fas fa-receipt cyan"></i>
        <p>{{ $t('salary_scale') }}</p>
      </router-link>
    </li>

    <li v-role="['Super Admin','Admin','Accountant']" class="nav-item">
      <router-link to="/manage-accounts" class="nav-link">
        <i class="nav-icon fas fa-receipt cyan"></i>
        <p>{{ $t('ManageAccount') }}</p>
      </router-link>
    </li>

    <!-- <li v-role="['Super Admin','Admin','Accountant']" class="nav-item">
            <router-link to="/manage-accounts" class="nav-link">
                <i class="nav-icon fas fa-bank cyan"></i>
                <p>{{ $t('ManageAccount') }}</p>
            </router-link>
        </li> -->
  </Fragment>
</template>

<script>
  import role from "../../directive/role/index";
  import permission from "../../directive/permission/permission";
  import { Fragment } from "vue-fragment";

  export default {
    name: "Accountant",
    components: { Fragment },
    directives: { role, permission },
  };
</script>

<style scoped></style>
