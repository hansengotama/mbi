<template>
    <div id="region-management">
        <panel title="Kelola Kecamatan">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                        </tr>
                        <tr v-if="region.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in region.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                        </tr>
                    </table>
                </div>
                <paginate :data="region" @changePaginate="changePaginate"></paginate>
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
                region: {
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
            this.getRegion()
        },
        methods: {
            getRegion() {
                request.get('/api/region?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                    .then((response) => {
                        this.region = response.data.result
                    })
            },
            search(text) {
                this.filter.text = text

                this.getRegion()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getRegion()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #region-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
