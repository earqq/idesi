<template>
    <div class="dashboard_content">
        <div class="dashboard_wrapper">
            <article class="numbers_stats">
                <div class="number_item n1">
                    <i class="material-icons-outlined"> swap_horiz </i>
                    <div class="stat">
                        <h1>150</h1>
                        <p>Prestamos Totales</p>
                    </div>
                </div>
                <div class="number_item n2">
                    <i class="material-icons-outlined"> shuffle </i>
                    <div class="stat">
                        <h1>10</h1>
                        <p>Prestamos Rechazados</p>
                    </div>
                </div>
                <div class="number_item n3">
                    <i class="material-icons-outlined"> person </i>
                    <div class="stat">
                        <h1>25</h1>
                        <p>Clientes Totales</p>
                    </div>
                </div>
            </article>
            <article class="chart_stats">
                <h2 class="title"> Historial / Año </h2>
            </article>
            <article class="lists">
                <div class="list_client">
                    <h2 class="title"> Nuevo Clientes </h2>
                </div>
                <div class="list_credits">
                    <h2 class="title"> Ultimos Prestamos </h2>
                </div>
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
        grid-template-rows: 100px 400px 500px
        grid-auto-rows: max-content
        grid-gap: 15px
        padding: 20px
        box-sizing: border-box
        .title
            font-size: 12px
            margin: 0
            width: 100%
            border-bottom: 1px solid $line_color
            font-weight: 700
            padding: 7px 20px
            text-transform: uppercase
        .numbers_stats
            display: grid
            grid-area: numbers 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 15px
            .number_item
                background-color: white
                border-radius: 4px
                box-shadow: $shadow
                height: 100%
                display: flex
                align-items: center
                padding: 20px
                box-sizing: border-box
                border: 1px solid $line_color
                &.n1
                    i
                        color: $primary_color
                        background-color: rgba($primary_color, .2)
                &.n2
                    i
                        color: $require_color
                        background-color: rgba($require_color, .2)
                &.n3
                    i
                        color: $highlight_color
                        background-color: rgba($highlight_color, .2)
                i
                    width: 50px
                    height: 50px
                    background-color: red
                    border-radius: 50%
                    display: flex
                    justify-content: center
                    align-items: center
                .stat
                    margin-left: 15px
                    h1, p
                        margin: 0
                    h1
                        font-size: 23px
                        font-weight: 700
                    p
                        font-size: 13px
                        margin-top: -2px
        .chart_stats
            grid-area: chart 
            background-color: white
            border-radius: 4px
            box-shadow: $shadow
            border: 1px solid $line_color
        .lists
            display: grid
            grid-area: lists 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 15px
            .list_client, .list_credits
                background-color: white
                border-radius: 4px
                box-shadow: $shadow
                height: 100%
                border: 1px solid $line_color
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
            border: 1px solid $line_color
</style>