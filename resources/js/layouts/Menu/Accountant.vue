<template>
    <Fragment>
        <li class="nav-header">Accountant Section</li>

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
    </Fragment>
</template>

<script>
import role from "../../directive/role/index";
import {Fragment} from "vue-fragment";

export default {
    name: "Accountant",
    components: {Fragment},
    directives: {role}
};
</script>

<style scoped></style>
