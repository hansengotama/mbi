<template>
    <div class="content-container">
        <div class="content-panel">
            <div class="content-title">
                {{ title }}
            </div>
            <div class="content-body">
                <slot name="body" />
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['title']
    }
</script>

<style lang="stylus" scoped>
    @import "./../../stylus/app.styl"

    .content-container
        width 100%
        padding 15px

    .content-container > .content-panel
        background white
        box-shadow(7px 7px 2px 0 #eaeaea)

    .content-container > .content-panel > .content-title
        text-transform uppercase
        padding 10px 15px
        border-bottom 1px solid #f0f0f0
        font-weight 600
        color $orange

    .content-container > .content-panel > .content-body
        padding 15px
</style>
