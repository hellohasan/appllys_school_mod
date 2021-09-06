<template>
    <Fragment>
        <li class="nav-header">Admin Section</li>
        <li v-role="['Super Admin','Admin']" class="nav-item">
            <router-link to="/customers" class="nav-link">
                <i class="nav-icon fas fa-users cyan"></i>
                <p>{{$t('Customers')}}</p>
            </router-link>
        </li>
        <li v-role="['Super Admin','Admin']" class="nav-item has-treeview">
            <a href="#!" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>{{ $t('Management') }}<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <router-link to="/users" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Manage User') }}</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li v-role="['Super Admin']" class="nav-item has-treeview">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-tools"></i>
                <p>{{ $t('Role & Permission') }}<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <router-link to="/roles" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Manage Role') }}</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/permission" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Manage Permission') }}</p>
                    </router-link>
                </li>
            </ul>
        </li>
    </Fragment>
</template>

<script>
import {Fragment} from 'vue-fragment'
import role from '../../directive/role/index'

export default {
    name: "Admin",
    components: {Fragment},
    directives: {role}
}
</script>

<style scoped>

</style>
