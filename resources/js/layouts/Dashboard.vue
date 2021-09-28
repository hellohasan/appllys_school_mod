<template>
    <div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
            </form>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> {{ locales[locale] }}
                    </a>
                    <div class="dropdown-menu" style="right: 0;left: auto">
                        <a v-for="(value, key) in locales" :key="key" class="dropdown-item" href="#"
                           @click.prevent="setLocale(key)">
                            {{ value }}
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img :src="authUser.photo" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ authUser.name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img :src="authUser.photo" class="img-circle elevation-2" alt="User Image">
                            <p>{{ authUser.name }} - {{ authUser.roles[0] }}
                            <small>{{ $t('MemberSince') }}: {{ authUser.created_at | date }}</small></p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer d-flex justify-content-between">
                            <router-link to="/profile" class="btn btn-primary btn-sm btn-flat text-white">
                                <i class="fas fa-user"></i> {{$t('profile')}}
                            </router-link>

                            <router-link to="/password" class="btn btn-success btn-sm btn-flat text-white">
                                <i class="fas fa-key"></i> {{$t('Password')}}
                            </router-link>

                            <a href="#" class="btn btn-danger btn-sm btn-flat text-white" @click.prevent="logout">
                                <i class="fas fa-sign-out-alt"></i> {{$t('logout')}}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img :src="site_logo" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Vue Admin</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="authUser.photo" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ authUser.name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">

                    <li class="nav-item">
                        <router-link to="/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt cyan"></i>
                            <p>{{ $t('Dashboard')}}</p>
                        </router-link>
                    </li>

                    <!--Register menu list-->
                    <Register></Register>

                    <!-- Accountant menu list-->
                    <Accountant></Accountant>


                    <!--Settings menu list-->
                    <Setting></Setting>

                    <!--Admin menu list-->
                    <Admin></Admin>
                    <!-- general menu list-->
                    <General></General>
                    <li class="nav-item">
                        <a href="" @click.prevent="logout" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt yellow"></i>
                            <p>{{$t('logout')}}</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content mt-4">
                <div class="container-fluid">
                    <transition name="fade" mode="out-in">
                    <router-view></router-view>
                    </transition>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">Version 1.0.1</div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</template>

<script>
import permission from '../directive/permission/index.js'
import role from '../directive/role/index.js'
import {setDocumentDirectionPerLocale,setDocumentLang} from "../plugins/document"
import Setting from "./Menu/Setting";
import Register from "./Menu/Register";
import Admin from './Menu/Admin'
import General from './Menu/General'
import Accountant from "./Menu/Accountant";
import axios from 'axios';
export default {
    components: {
        Setting,
        Register,
        Admin,
        General,
        Accountant
    },
    directives:{permission,role},
    data(){
        return{
            site_logo : process.env.MIX_APP_URL+'img/logo.png'
        }
    },
    methods:{
        logout(){
            this.$store.commit('logout');
            this.$router.push({path:'/login'})
        },
        setLocale (locale) {
            if (this.$i18n.locale !== locale) {
                this.$i18n.locale = locale;
                let lang = this.$i18n.locale
                setDocumentLang(lang)
                setDocumentDirectionPerLocale(lang)
                this.$store.dispatch('setLocale', locale )
                axios.get('/api/change-language',{params:{lang:lang}}).then((res)=>{
                    Toast.fire({
                        icon: 'success',
                        title: this.$t('language_update')
                    })
                })
                location.reload();
            }
        }
    },
    computed:{
        authUser(){
            return this.$store.getters.currentUser;
        },
        locale(){
            return this.$store.getters.locale
        },
        locales() {
            return this.$store.getters.locales
        }
    }
}
</script>

<style lang="scss">
    .fade-enter, .fade-leave-to{
        opacity: 0;
        transform: translateX(2em);
    }
    .fade-enter-active, .fade-leave-active{
        transition: all .5s ease;
    }
</style>
