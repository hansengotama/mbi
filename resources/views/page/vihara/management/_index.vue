<template>
    <div id="vihara-management">
        <panel title="Kelola Vihara">
            <template slot="body">
                <search @search="search" class="mt-3"></search>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="vihara.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in vihara.data" v-else>
                            <td>{{ index + 1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.phone_number }}</td>
                            <td>{{ data.address }}</td>
                            <td width="150px" class="text-center">
                                <i class="fa fa-edit" @click="editVihara(data)"></i>
                                <i class="fa fa-trash" @click="confirmationDeleteVihara(data)"></i>
                            </td>
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
    import alert from "../../../../helper/alert"

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
        watch: {
            selectedRegion: {
                immediate: true,
                deep: true,
                handler() {
                    this.getVihara()
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
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"]
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value)
                }
            }
        },
        methods: {
            getVihara() {
                if(this.accessToken && this.selectedRegion.id) {
                    request.get('/api/vihara?filter[text]=' + this.filter.text + '&filter[page]=' + this.filter.page + '&filter[per_page]=' + this.filter.per_page + '&filter[region_id]=' + this.selectedRegion.id, this.accessToken)
                    .then((response) => {
                        if (response.data.success)
                            this.vihara = response.data.result
                    })
                }
            },
            search(text) {
                this.filter.text = text

                this.getVihara()
            },
            changePaginate(data) {
                this.filter.page = data.page
                this.filter.per_page = data.per_page

                this.getVihara()
            },
            editVihara(data) {
                this.$router.push({
                    name: "Edit Vihara",
                    params: {data: data}
                })
            },
            confirmationDeleteVihara(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus vihara ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.deleteVihara(data.id)
                })
            },
            deleteVihara(id) {
                alert.loading()

                request.post('/api/vihara/delete/'+id, null, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getVihara()
                    }else
                        alert.error()
                })
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
