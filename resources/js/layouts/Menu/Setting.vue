<template>
    <fragment>
        <li v-role="['Super Admin','Admin']" class="nav-header">Settings Section</li>
        <li v-role="['Super Admin','Admin']" class="nav-item">
            <router-link to="/basic-setting" class="nav-link">
                <i class="nav-icon fas fa-sliders-h cyan"></i>
                <p>{{$t('basic_setting')}}</p>
            </router-link>
        </li>

        <li v-role="['Super Admin','Admin']" class="nav-item has-treeview">
            <a href="#!" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>{{$t('App_setting')}}<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                    <router-link to="/email-setting" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Email_setting') }}</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/email-template" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Email_template') }}</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/sms-setting" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{ $t('Sms_setting') }}</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li v-role="['Super Admin','Admin']" class="nav-item">
            <router-link to="/image-setting" class="nav-link">
                <i class="nav-icon fas fa-images cyan"></i>
                <p>{{$t('image_setting')}}</p>
            </router-link>
        </li>
    </fragment>
</template>

<script>
import { Fragment } from 'vue-fragment'
import role from "../../directive/role/index";
export default {
    name: "Setting",
    directives:{role},
    components: { Fragment }
}
</script>

<style scoped>

</style>
