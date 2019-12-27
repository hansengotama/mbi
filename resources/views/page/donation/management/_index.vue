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
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="donation.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in donation.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.donors_name }}</td>
                            <td>{{ data.amount }}</td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editDonation(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteDonation(data)"></i>
                            </td>
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
    import alert from "../../../../helper/alert";

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
        computed: {
            userLogin: {
                get() {
                    return this.$store.getters["getUserLogin"]
                },
                set(value) {
                    this.$store.commit("setUserLogin", value)
                }
            },
        },
        mounted() {
            this.getDonation()
        },
        methods: {
            getDonation() {
                if(this.accessToken) {
                    request.get('/api/donation?filter[text]=' + this.filter.text + '&filter[page]=' + this.filter.page + '&filter[per_page]=' + this.filter.per_page + '&filter[district_id]=' + this.userLogin.district_id, this.accessToken)
                    .then((response) => {
                        if(response.data.success)
                            this.donation = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getDonation()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getDonation()
            },
            editDonation(data) {
                this.$router.push({
                    name: "Edit Donation",
                    params: {data: data}
                })
            },
            confirmationDeleteDonation(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus donasi dari ' + data.donors_name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteDonation(data.id)
                })
            },
            deleteDonation(id) {
                alert.loading()

                request.post('/api/donation/delete/'+id, null, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getDonation()
                    }else
                        alert.error()
                })
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

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-edit
        margin-right 4px
        background $orange

    td > .fa-trash
        background red
</style>
