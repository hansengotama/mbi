<template>
    <div id="vihara-management">
        <panel title="Kelola Vihara">
            <template slot="body">
                <search @search="search"></search>
                <div class="">
                    <select name="">
                        <option value="adasdf">adasdf</option>
                        <option value="adasdf">adasdf</option>
                        <option value="adasdf">adasdf</option>
                        <option value="adasdf">adasdf</option>
                    </select>
                </div>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                        </tr>
                        <tr v-if="vihara.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in vihara.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.phone_number }}</td>
                            <td>{{ data.address }}</td>
                        </tr>
                    </table>
                </div>
                <paginate :data="vihara" @changePaginate="changePaginate"></paginate>
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
                vihara: {
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
            this.getVihara()
        },
        methods: {
            getVihara() {
                request.get('/api/vihara?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                    .then((response) => {
                        this.vihara = response.data.result
                    })
            },
            search(text) {
                this.filter.text = text

                this.getVihara()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getVihara()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #vihara-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
