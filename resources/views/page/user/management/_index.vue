<template>
    <div id="user-management">
        <panel title="Kelola Pengguna">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Nomor Telepon</th>
                            <th>Peran</th>
                            <th>Jenis Kelamin</th>
                            <th>No. KTUB</th>
                        </tr>
                        <tr v-if="user.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in user.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.email }}</td>
                            <td>{{ data.birth_of_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>
                                <span v-if="data.place_of_birth">
                                    {{ data.place_of_birth }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>{{ data.phone_number }}</td>
                            <td>{{ data.role }}</td>
                            <td>
                                <span v-if="data.blood_type">
                                    {{ data.blood_type }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                <span v-if="data.ktub_number">
                                    {{ data.ktub_number }}
                                </span>
                                <span v-else>-</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="user" @changePaginate="changePaginate"></paginate>
            </template>
        </panel>
    </div>
</template>

<script>
    import request from "../../../../helper/request"

    export default {
        props: ['accessToken'],
        components: {
            Panel: () => import('../../../../components/panel/_index'),
            Search: () => import('../../../../components/search/_index'),
            Paginate: () => import('../../../../components/paginate/_index')
        },
        data() {
            return {
                user: {
                    data: []
                },
                filter: {
                    text: "",
                    page: 1,
                    per_page: 10
                }
            }
        },
        mounted() {
            this.getUser()
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
        methods: {
            getUser() {
                if(this.accessToken) {
                    request.get('/api/user?filter[text]=' + this.filter.text + '&filter[page]=' + this.filter.page + '&filter[per_page]=' + this.filter.per_page + '&filter[district_id]=' + this.userLogin.district_id, this.accessToken)
                    .then((response) => {
                        if(response.data.success)
                            this.user = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getUser()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getUser()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #user-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
