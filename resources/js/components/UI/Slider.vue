<template>
  <div class="slider__wrapper">
    <div class="testing__slider">
      <div class="elements__slider__marks" v-for="item in items" :key="item.id" @click="activate_mark($event, item)">
        <span class="elements__slider__label">
          {{ item.max_followers > 0 ? `${item.max_followers / 1000}к` : '∞' }}   
        </span>                    
      </div>
    </div>
    <div class="elements__slider__marks active__mark" ref="active__mark"></div>
  </div>
</template>

<script>
	export default {
		name: 'Slider',
		data() {
			return {

			}
		},
		props: {
			items: {
				type: Array,
				default: []
			}
		},
		methods: {
      activate_mark(el, item) {
        this.$refs.active__mark.style = `left: ${el.target.offsetLeft - 24}px`
        this.$emit("choosed", item)
      },
		}
	}
</script>

<style scoped lang="scss">
    .slider__wrapper {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .testing__slider {
        width: 100%;
        height: 6px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: #C4C4C4;
        border-radius: 1.5px;
    }
    .elements__slider {
        &__marks {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background-color: #C4C4C4;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;

        }
    }
    .active__mark {
        left: 0px;
        transition: 0.2s;
        background: linear-gradient(141.16deg, #D6E9F5 -0.37%, #ADD2EB 96.94%);
        position: relative;
        top: -11px;
    }
    .elements__slider__label {
        position: relative;
        top: 24px;
        font-size: 12px;
    }
</style>