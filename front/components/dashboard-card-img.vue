<template>
    <div class="elements elements-img"> 
        <h4> {{title}} </h4>
        <img  :src="img" :alt="alt"/>
    </div>
</template>

<script>
export default {
    props: {
        title: { type: String, default: "" },
        img: { type: String, default: "" },
        alt: { type: String, default:""}
    },
    data () {
        return {

        }
    }
}
</script>