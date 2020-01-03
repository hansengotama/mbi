<template>
    <div id="edit-profile">
        <panel title="Profile" v-show="!isEdit">
            <template slot="body">
                <div style="position: relative">
                    <div class="profile-container">
                        <div class="profile">
                            <div class="title">Nama</div>
                            <div class="value">: {{userLogin.name}}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Email</div>
                            <div class="value">: {{userLogin.email}}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Tanggal Lahir</div>
                            <div class="value">: {{userLogin.birth_of_date}}</div>
                        </div>
                        <div class="profile">
                            <div class="title">Nomor Telepon</div>
                            <div class="value">: {{userLogin.phone_number}}</div>
                        </div>
                    </div>
                    <div class="edit-button" @click="editProfile()">
                        Edit <i class="fa fa-edit"></i>
                    </div>
                </div>
            </template>
        </panel>
        <panel title="Edit Profile" v-show="isEdit">

        </panel>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isEdit: false
            }
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
        },
        methods: {
            editProfile() {
                this.isEdit = true
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

    .profile-container > .profile >  .value
        flex 2

    .edit-button
        position absolute
        top 0
        right 0
        cursor pointer

</style>
