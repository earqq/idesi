<template>
    <div class="dashboard_content">
        <div class="dashboard_wrapper">
            <article class="numbers_stats">
                <div class="number_item"></div>
                <div class="number_item"></div>
                <div class="number_item"></div>
            </article>
            <article class="chart_stats">
            </article>
            <article class="lists">
                <div class="list_client"></div>
                <div class="list_credits"></div>
            </article>
            <aside class="map">
            </aside>
        </div>
    </div>
</template>

<script>
export default {
};
</script>
<style lang="sass" scoped>
@import "../../sass/_variables"
.dashboard_content
    .dashboard_wrapper
        display: grid
        grid-template-areas: "numbers map" "chart map" "lists map"
        grid-template-columns: 1fr 500px
        grid-template-rows: 100px 350px 500px
        grid-auto-rows: max-content
        grid-gap: 20px
        padding: 20px
        box-sizing: border-box 
        .numbers_stats
            display: grid
            grid-area: numbers 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 20px
            .number_item
                background-color: white
                border-radius: 4px
                box-shadow: $shadow
                height: 100%
        .chart_stats
            grid-area: chart 
            background-color: white
            border-radius: 4px
            box-shadow: $shadow
        .lists
            display: grid
            grid-area: lists 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 20px
            .list_client, .list_credits
                background-color: white
                border-radius: 4px
                box-shadow: $shadow
                height: 100%
            .list_credits
                grid-column: 2 / 2 span
        .map
            grid-area: map
            background-color: white
            border-radius: 4px
            box-shadow: $shadow
            height: calc(100vh - 95px)
            overflow: hidden
            position: sticky
            top: 75px
</style>