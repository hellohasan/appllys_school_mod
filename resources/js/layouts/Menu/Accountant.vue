<template>
    <Fragment>
        <li class="nav-header">Accountant Section</li>
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
