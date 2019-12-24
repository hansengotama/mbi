<template>
    <div id="request-ktub-management">
        <panel title="Kelola Permohonan KTUB">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>No. KTP</th>
                            <th>No. KK</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Nama Visudhi</th>
                            <th>Tempat Visudhi</th>
                            <th>Guru Visudhi</th>
                            <th>Tipe Visudhi</th>
                            <th>Nama Usaha</th>
                            <th>Diterima Oleh</th>
                        </tr>
                        <tr v-if="requestKtub.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in requestKtub.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.photo_url }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.id_number }}</td>
                            <td>{{ data.family_card_number }}</td>
                            <td>{{ data.last_education }}</td>
                            <td>{{ data.visudhi_name }}</td>
                            <td>{{ data.visudhi_place }}</td>
                            <td>{{ data.visudhi_teacher }}</td>
                            <td>{{ data.visudhi_role }}</td>
                            <td>{{ data.business_name }}</td>
                            <td>
                                <span v-if="data.accepted_admin_id">
                                    {{ data.accepted_admin_id }}
                                </span>
                                <span v-else>
                                    -
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="requestKtub" @changePaginate="changePaginate"></paginate>
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
                requestKtub: {
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
            this.getRequestKtub()
        },
        methods: {
            getRequestKtub() {
                request.get('/api/request-ktub?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                    .then((response) => {
                        this.requestKtub = response.data.result
                    })
            },
            search(text) {
                this.filter.text = text

                this.getRequestKtub()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getRequestKtub()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #request-ktub-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
