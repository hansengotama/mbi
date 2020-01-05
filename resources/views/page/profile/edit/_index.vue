<template>
    <div id="edit-profile">
        <panel title="Profile" v-if="!isEdit">
            <template slot="body">
                <div style="position: relative">
                    <div class="profile-container">
                        <div class="profile">
                            <div class="title">Nama</div>
                            <div class="value">: {{ userLogin.name }}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Email</div>
                            <div class="value">: {{ userLogin.email }}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Tanggal Lahir</div>
                            <div class="value">: {{ userLogin.birth_of_date | dateFormat('DD MMMM YYYY') }}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Nomor Telepon</div>
                            <div class="value">: {{ userLogin.phone_number }}</div>
                        </div>
                    </div>
                    <div class="edit-button" @click="editProfile()">
                        Edit <i class="fa fa-edit"></i>
                    </div>
                </div>
            </template>
        </panel>
        <panel title="Edit Profile" v-else>
            <template slot="body">
                <form-profile-edit :loading="loading"
                                   :formData="formData"
                                   @saveProfile="saveProfile"
                ></form-profile-edit>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request";
    import alert from "../../../../helper/alert";

    export default {
        props: ['accessToken'],
        data() {
            return {
                isEdit: false,
                formData: {
                    name: "",
                    email: "",
                    birth_of_date: "",
                    phone_number: ""
                },
                loading: false
            }
        },
        mounted() {
            this.formData.name = this.userLogin.name
            this.formData.email = this.userLogin.email
            this.formData.birth_of_date = this.userLogin.birth_of_date
            this.formData.phone_number = this.userLogin.phone_number
        },
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"];
                },
                set(value) {
                    this.$store.commit("setUserLogin", value);
                }
            }
        },
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            FormProfileEdit: () => import('../form/_index')
        },
        methods: {
            editProfile() {
                this.isEdit = true
            },
            saveProfile() {
                this.loading = true

                this.formData.district_id = this.userLogin.district_id
                this.formData.region_id = this.userLogin.region_id
                this.formData.role = this.userLogin.role
                request.post('/api/user/update/' + this.userLogin.id, this.formData, this.accessToken)
                .then((response) => {
                    this.loading = false

                    if(response.data.success) {
                        this.isEdit = false
                        this.getUserData()
                        alert.success()
                    }else alert.error(response.data.message)
                })
            },
            getUserData() {
                request.get('/api/user/' + this.userLogin.id, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        this.userLogin = response.data.result
                    }
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    .profile-container > .profile
        display flex

    .profile-container > .profile > .title
        flex 1
        margin 1em 0

    .profile-container > .profile >  .value
        flex 2
        margin 1em 0

    .edit-button
        position absolute
        top 0
        right 0
        cursor pointer
        padding 5px 10px
        background #eaeaea
        border-radius 5px

</style>
