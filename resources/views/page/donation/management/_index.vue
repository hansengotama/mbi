<template>
    <div id="donation-management">
        <panel title="Kelola Donasi">
            <template slot="body">
                <search @search="search"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama Donatur</th>
                            <th>Jumlah</th>
                            <th>Alamat</th>
                        </tr>
                        <tr v-if="donation.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in donation.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.donors_name }}</td>
                            <td>{{ data.amount }}</td>
                            <td>{{ data.address }}</td>
                        </tr>
                    </table>
                </div>
                <paginate :data="donation" @changePaginate="changePaginate"></paginate>
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
                donation: {
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
            this.getDonation()
        },
        methods: {
            getDonation() {
                request.get('/api/donation?filter[text]='+ this.filter.text + '&filter[page]='+ this.filter.page +'&filter[per_page]=' + this.filter.per_page, this.accessToken)
                .then((response) => {
                    this.donation = response.data.result
                })
            },
            search(text) {
                this.filter.text = text

                this.getDonation()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getDonation()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #donation-management
        padding-top 15px

    .table-container
        margin-top 2em
        margin-bottom 1em
</style>
