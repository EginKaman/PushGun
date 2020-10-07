<template>
    <label for="image" class="site_avatar_form">
        <input type="file" name="image" id="image" accept="image/*" @change="uploadImage">
        <img :src="uploaded || image" alt="">
        <div class="site_avatar_form_block">
            <p class="site_avatar_form_title">{{ $t('Выберите изображение') }}</p>
            <p class="site_avatar_form_desc">
                {{ $t('Рекомендуемый размер: 128×128px JPG, svg до 200KB') }}
            </p>
        </div>
    </label>
</template>

<script>
export default {
    name: "Image",
    props: {
        image: {
            type: String,
            default: '/images/site.svg'
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
