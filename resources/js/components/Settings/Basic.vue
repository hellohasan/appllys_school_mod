<template>
    <card :title="$t('basic_setting')">
        <form @submit.prevent="submitBasicData" role="form" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="title">{{ $t("app_title") }}</label>
                        <input
                            type="text"
                            v-model="form.title"
                            :class="{ 'is-invalid': form.errors.has('title') }"
                            id="title"
                            placeholder="Application Title"
                            class="form-control"
                        />
                        <has-error :form="form" field="title"></has-error>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="type">{{ $t("app_title") }}</label>
                        <select2
                            :options="levels"
                            v-model="form.level"
                            placeholder="Select One"
                            name="type"
                        ></select2>
                        <has-error :form="form" field="level"></has-error>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="est">{{ $t("app_est") }}</label>
                        <input
                            type="text"
                            v-model="form.est"
                            :class="{ 'is-invalid': form.errors.has('est') }"
                            id="est"
                            placeholder="Application Establish"
                            class="form-control"
                        />
                        <has-error :form="form" field="est"></has-error>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="phone">{{ $t("Phone") }}</label>
                        <input
                            type="text"
                            v-model="form.phone"
                            :class="{ 'is-invalid': form.errors.has('phone') }"
                            id="phone"
                            placeholder="Phone Number"
                            class="form-control"
                        />
                        <has-error :form="form" field="phone"></has-error>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="email">{{ $t("Email") }}</label>
                        <input
                            type="text"
                            v-model="form.email"
                            :class="{ 'is-invalid': form.errors.has('email') }"
                            id="email"
                            placeholder="Email Address"
                            class="form-control"
                        />
                        <has-error :form="form" field="email"></has-error>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="address">{{ $t("Address") }}</label>
                        <input
                            type="text"
                            v-model="form.address"
                            :class="{
                                'is-invalid': form.errors.has('address')
                            }"
                            id="address"
                            placeholder="Address"
                            class="form-control"
                        />
                        <has-error :form="form" field="address"></has-error>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="copy_text">{{ $t("Copy_text") }}</label>
                        <input
                            type="text"
                            v-model="form.copy_text"
                            :class="{
                                'is-invalid': form.errors.has('copy_text')
                            }"
                            id="copy_text"
                            placeholder="Copy Right Text"
                            class="form-control"
                        />
                        <has-error :form="form" field="copy_text"></has-error>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <v-button :loading="form.busy">
                            <i class="fas fa-cogs"></i> {{ $t("Update") }}
                        </v-button>
                    </div>
                </div>
            </div>
        </form>
    </card>
</template>

<script>
import Cookies from "js-cookie";
import Select2 from "../globals/Select2";
export default {
    name: "Basic",
    components: {
        Select2
    },
    data() {
        return {
            form: new Form({
                title: "",
                est: "",
                email: "",
                phone: "",
                address: "",
                copy_text: "",
                level: ""
            }),
            levels: [
                { id: 1, text: "Secondary" },
                { id: 2, text: "Higher Secondary" },
                { id: 3, text: "Higher & Graduation" },
                { id: 4, text: "Graduation" }
            ]
        };
    },
    methods: {
        submitBasicData() {
            this.form.post("/api/basic-setting-update").then(response => {
                let basic = {
                    title: this.form.title,
                    email: this.form.email,
                    phone: this.form.phone,
                    address: this.form.address,
                    copy_text: this.form.copy_text
                };
                Cookies.set("basic", basic, { expires: 365 });
                this.$store.commit("updateBasicData", basic);
                Toast.fire({
                    icon: "success",
                    title: this.$t("success_message")
                });
            });
        },
        loadBasicSetting() {
            axios
                .get("api/basic-setting")
                .then(({ data }) => this.form.fill(data));
        } /*,
        loadDatabase() {
            axios.get('api/roles').then(({data}) => {
                this.options = data.map(x => ({id:x.id, text: x.name}))
            })
        }*/
    },
    created() {
        this.loadBasicSetting();
    }
};
</script>

<style scoped></style>
