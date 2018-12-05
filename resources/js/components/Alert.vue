<template>

<div v-if='!isHidden' class="bg-teal-darkest text-center py-4 lg:px-4">
  <div class="p-2 bg-teal-darker items-center text-teal-lightest leading-none lg:rounded-full flex lg:inline-flex" role="alert">
    <span class="font-semibold mr-2 text-left flex-auto ml-3">Compra realizada de forma correcta</span>
    <a v-on:click="greet" class="cursor-pointer no-underline text-grey-lightest hover:text-soft-black">
      <span class="flex rounded-full bg-teal uppercase px-2 py-1 text-xs font-bold mx-3">Ver factura</span>
    </a>
  </div>
</div>

</template>

<script>

	export default {
		data(){
			return{
				isHidden: false
			}
		},
    methods: {
    greet: function (event) {
      this.isHidden = true
      window.location = "https://don-balon.salvadormontiel.com/ver-factura"
    }
  }
	}
</script>
