<template>
    <div id="district-management-pic-region">
        <panel title="Kelola PIC Kecamatan">
            <template slot="body">
                <search @search="search" class="mt-3"></search>
                <div class="table-container mt-3">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        <tr v-if="picRegion.data.length == 0">
                            <td colspan="100%" align="center" bgcolor="#f0f0f0">Tidak ada data</td>
                        </tr>
                        <tr v-for="(data, index) in picRegion.data" v-else>
                            <td>{{ index+1 }}</td>
                            <td>{{ data.name }}</td>
                            <td>{{ data.email }}</td>
                            <td>{{ data.phone_number }}</td>
                            <td width="100px" class="text-center">
                                <i class="fa fa-key" @click="confirmationResetPassword(data)"></i>
                                <i class="fa fa-trash" @click="confirmationRemovePicRegion(data)"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <paginate :data="picRegion" @changePaginate="changePaginatePicRegion"></paginate>
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
                picRegion: {
                    data: []
                },
                picRegionFilter: {
                    page: 1,
                    per_page: 10,
                    text: ""
                },
                district: {},
            }
        },
        watch: {
            selectedRegion: {
                handler() {
                    this.getPicRegion()
                },
                deep: true,
                immediate: true
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
            },
            selectedRegion: {
                get() {
                    return this.$store.getters["getSelectedRegion"];
                },
                set(value) {
                    this.$store.commit("setSelectedRegion", value);
                }
            }
        },
        methods: {
            search(text) {
                this.picRegionFilter.text = text

                this.getPicRegion()
            },
            changePaginatePicRegion(data) {
                this.picRegionFilter.page = data.page
                this.picRegionFilter.per_page = data.per_page

                this.getPicRegion()
            },
            getPicRegion() {
                if(this.accessToken) {
                    request.get('/api/user/?filter[role]=pic_kecamatan' +
                        '&filter[district_id]=' + this.userLogin.district_id +
                        '&filter[region_id]=' + this.selectedRegion.id +
                        '&filter[page]=' + this.picRegionFilter.page +
                        '&filter[per_page]=' + this.picRegionFilter.per_page +
                        '&filter[text]=' + this.picRegionFilter.text,
                        this.accessToken)
                        .then((response) => {
                            if (response.data.success)
                                this.picRegion = response.data.result
                        })
                }
            },
            confirmationRemovePicRegion(data) {
                alert.confirmation('Apakah kamu yakin untuk menghapus pic kecamatan ' + data.name + ' ?', 'Hapus', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.removePicRegion(data)
                })
            },
            confirmationResetPassword(data) {
                let password = "jayalahmbi"

                alert.confirmation('Apakah kamu yakin untuk atur ulang password pic kecamatan ' + data.name + ' menjadi '+ '"' +password+ '"' +' ?', 'Ganti', 'Tidak')
                .then((dialog) => {
                    if(dialog.value)
                        this.resetPasswordPicRegion(data, password)
                })
            },
            resetPasswordPicRegion(data, password) {
                alert.loading()

                data.password = password
                request.post('/api/user/update/' + data.id, data, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getPicRegion()
                    }else {
                        alert.error()
                    }
                })
            },
            removePicRegion(data) {
                alert.loading()

                data.role = "user"
                delete data.password
                request.post('/api/user/update/' + data.id, data, this.accessToken)
                .then((response) => {
                    if(response.data.success) {
                        alert.success()
                        this.getPicRegion()
                    }else {
                        alert.error()
                    }
                })
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../../../stylus/app.styl"

    #district-management-picRegion
        padding-top 15px

    .back-to-management
        padding-left 15px
        color $orange
        font-weight 700
        cursor pointer
        margin-top 1em

    .table-container
        margin-top 2em
        margin-bottom 1em

    .add-button
        background $orange
        border none
        border-bottom 3px solid darkgoldenrod
        color white
        padding 5px 18px
        border-radius 5px
        cursor pointer

    .filter-container
        display flex
        align-items flex-end
        margin-top -1em

    .filter-container > select
        height 36px
        border 2px solid #eaeaea
        border-radius 8px
        background white
        margin-right 15px
        padding 0 5px
        width 220px

    option
        cursor pointer !important

    td > .fa,
    td > .fas
        padding 6px
        color white
        border-radius 4px
        cursor pointer

    td > .fa-trash
        background red

    td > .fa-key
        background $orange
</style>
