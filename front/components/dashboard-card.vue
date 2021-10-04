<template>
    <div class="elements"> 
        <h4> {{title}} </h4>
        <p class="val"> {{value}} </p>
    </div>
</template>

<script>
export default {
    props: {
        title: { type: String, default: "" },
        value: { type: String, default: "" }
    },
    data () {
        return {

        }
    }
}
</script>
