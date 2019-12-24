<template>
    <div id="deceased-management">
        <panel title="Kelola Orang Meninggal">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Umur Terakhir</th>
                            <th>Tgl Pemakaman</th>
                            <th>Tempat Pemakaman</th>
                            <th>Tgl Meninggaal</th>
                            <th>Tipe</th>
                        </tr>
                        <tr v-if="deceased.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in deceased.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.photo_url }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.close_age }}</td>
                            <td>{{ data.buried_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>{{ data.deceased_date | dateFormat('DD MMMM YYYY') }}</td>
                            <td>{{ data.buried_at }}</td>
                            <td>{{ data.type }}</td>
                        </tr>
                    </table>
                </div>
                <paginate :data="deceased" @changePaginate="changePaginate"></paginate>
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
                deceased: {
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
            this.getDeceased()
        },
        methods: {
            getDeceased() {
                request.get('/api/deceased?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                    .then((response) => {
                        this.deceased = response.data.result
                    })
            },
            search(text) {
                this.filter.text = text

                this.getDeceased()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getDeceased()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #deceased-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
