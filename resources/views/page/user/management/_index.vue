<template>
    <div id="user-management">
        <panel title="Kelola Pengguna">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Nomor Telepon</th>
                            <th>Peran</th>
                            <th>Jenis Kelamin</th>
                            <th>No. KTUB</th>
                        </tr>
                        <tr v-for="user in user.data">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.birth_of_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>
                                <span v-if="user.place_of_birth">
                                    {{ user.place_of_birth }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>{{ user.phone_number }}</td>
                            <td>{{ user.role }}</td>
                            <td>
                                <span v-if="user.blood_type">
                                    {{ user.blood_type }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                <span v-if="user.ktub_number">
                                    {{ user.ktub_number }}
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
                user: {},
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
        methods: {
            getUser() {
                request.get('/api/user?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                    .then((response) => {
                        this.user = response.data.result
                    })
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
