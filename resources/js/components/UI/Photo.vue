<template>
    <label for="photo" class="set-form__label photo">
        <div class="set-form__title-wrap">
            <span class="set-form__title">{{ $t('Фото профиля') }}</span>
            <span
                class="set-form__desc">{{ $t('Рекомендуемый размер фото') }}:<br>150px × 150px</span>
        </div>
        <input type="file" name="photo" id="photo" accept="image/*" @change="uploadImage">
        <div class="photo-min" id="output">
            <img :src="uploaded || image" alt="">
        </div>
    </label>
</template>

<script>
export default {
    name: "Photo",
    props: {
        image: {
            type: String,
            default: '/images/minPhoto.svg'
        }
    },
    data() {
        return {
            uploaded: '',
        }
    },
    methods: {
        uploadImage(event) {
            let file = event.target.files.item(0);
            let reader = new FileReader();
            reader.addEventListener("load", this.imageLoaded);
            reader.readAsDataURL(file);
        },
        imageLoaded(event) {
            this.uploaded = event.target.result;
        },
    }
}
</script>

<style scoped>

</style>
