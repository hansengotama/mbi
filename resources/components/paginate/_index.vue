<template>
    <div class="pagination">
        <div class="per-page-container">
            <div class="per-page-select">
                <select @change="goPerPage()" v-model="current.per_page">
                    <option v-for="option in perPageOption">
                        {{ option }}
                    </option>
                </select>
            </div>
        </div>
        <div class="page-container">
            <span class="pages-style"
                  v-show="show.first"
                  @click="goPage(1)">
                <<
            </span>
            <span class="pages-style"
                  v-show="show.prev"
                  @click="goPage('prev')">
                <
            </span>
            <span v-show="data" v-for="page in pages">
                <span class="pages-style"
                      :class="{ active: current.page == page }"
                      @click="goPage(page)">
                    {{ page }}
                </span>
            </span>
            <span class="pages-style"
                  v-show="show.next"
                  @click="goPage('next')">
                >
            </span>
            <span class="pages-style"
                  v-show="show.last"
                  @click="goPage(data.last_page)">
                >>
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            data: {},
            perPageOption: {
                required: false,
                default: () => ['10', '25', '50', '100']
            }
        },
        data() {
            return {
                pages: [],
                show: {
                    first: false,
                    last: false,
                    prev: false,
                    next: false
                },
                current: {
                    page: 1,
                    per_page: this.perPageOption[0]
                }
            }
        },
        watch: {
            data: {
                handler() {
                    this.initPaginate()
                },
                deep: true,
                immediate: true
            }
        },
        methods: {
            initPaginate() {
                this.current.page = this.data.current_page

                this.pages = []

                if(this.data.current_page > 1) {
                    this.show.first = true
                    this.show.prev = true
                }else {
                    this.show.first = false
                    this.show.prev = false
                }

                if (this.data.current_page < this.data.last_page) {
                    this.show.last = true
                    this.show.next = true
                }else {
                    this.show.last = false
                    this.show.next = false
                }

                let remainingPage = this.data.last_page - this.data.current_page

                if(this.data.last_page <= 5) {
                    for(let i = 1; i <= this.data.last_page; i++) {
                        this.pages.push(i)
                    }
                }else {
                    if(remainingPage >= 2) {
                        if(this.data.current_page <= 2) {
                            for(let i = 1; i <= 5; i++) {
                                this.pages.push(i)
                            }
                        }else {
                            for(let i = this.data.current_page-2; i <= this.data.current_page+2; i++) {
                                this.pages.push(i)
                            }
                        }
                    }else {
                        for(let i = this.data.last_page-4; i <= this.data.last_page; i++) {
                            this.pages.push(i)
                        }
                    }
                }
            },
            changePaginate(){
                this.$emit('changePaginate', this.current)
            },
            goPerPage() {
                this.current.page = 1
                this.changePaginate()
            },
            goPage(page) {
                if(page == "prev")
                    page = parseInt(this.current.page) - 1

                if(page == "next")
                    page = parseInt(this.current.page) + 1

                this.current.page = page
                this.changePaginate()
            }
        }
    }
</script>

<style lang="stylus" scoped>
    @import "./../../stylus/app.styl"

    .pagination
        display flex
        align-items center

    .pagination > .per-page-container
        flex 6
        display inline-flex
        align-items center

    .pagination > .page-container
        flex 6
        text-align right

    .pagination > .per-page-container > .per-page-select > select:active,
    .pagination > .per-page-container > .per-page-select > select:focus
        outline none !important
        box-shadow none
        border 1px solid #eaeaea

    .pagination > .per-page-container > .per-page-select > select
        cursor pointer
        border 1px solid #eaeaea
        background white
        padding 8px 10px

    .pagination > .page-container .pages-style
        padding 6px 10px
        margin 0 6px
        border-radius 10px
        color $orange
        font-weight 600
        cursor pointer

    .pagination > .page-container .pages-style.active
        background $orange
        color white
</style>
