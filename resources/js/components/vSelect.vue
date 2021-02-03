<template>
    <div>
        <div
            class="v-select"
            :style="{
                maxWidth: `${maxWidth.size}${maxWidth.unit}`
            }"
            :class="positionLabelClass"
        >
            <label v-if="label.show">
                {{ label.text }}
            </label>
            <p @click="switchSelect" ref="selectText">
                {{ text }}
                <span v-if="isShowIcon" class="material-icons"
                    >keyboard_arrow_down
                </span>
            </p>

            <ul
                v-if="isActive"
                v-click-outside="close"
                class="selectList custom-scroll "
            >
                <li
                    v-if="resetOption.isShow"
                    @click="reset"
                    class="v-select_li__hover"
                >
                    <label class="resetOption pointer">
                        {{ resetOption.text }}
                    </label>
                </li>
                <li
                    v-for="item in data"
                    :key="item[keyName]"
                    @click="select(item)"
                    class="v-select_li__hover"
                >
                    <input
                        v-if="isShowCheckbox"
                        type="checkbox"
                        :checked="isSelected(item[keyName])"
                        :id="`selectItem${item[keyName]}`"
                    />
                    <label
                        ref="selectItem"
                        class="v-select__optionName pointer"
                    >
                        {{
                            translate.use
                                ? $t(item[optionName], translate.lang)
                                : item[optionName]
                        }}
                        {{
                            additionalOptionName.isShow
                                ? `( ${item[additionalOptionName.optionName]} ${
                                      additionalOptionName.label
                                  } )`
                                : ""
                        }}
                    </label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import vClickOutside from "v-click-outside";
export default {
    name: "vSelect",
    data: () => ({
        isActive: false,
        selectedId: null,
        selectText: [],
        selected: []
    }),
    directives: {
        clickOutside: vClickOutside.directive
    },
    props: {
        defaultValue: {
            type: Object,
            default() {
                return {
                    isActive: false,
                    key: null,
                    keys: null
                };
            }
        },
        isShowCheckbox: {
            type: Boolean,
            default: true
        },
        isShowIcon: {
            type: Boolean,
            default: true
        },
        translate: {
            type: Object,
            default() {
                return {
                    use: false,
                    lang: "ru"
                };
            }
        },
        maxWidth: {
            type: Object,
            default() {
                return {
                    size: 100,
                    unit: "%"
                };
            }
        },
        mode: {
            type: String,
            default: "Single"
        },
        data: {
            type: Array,
            required: true
        },
        optionName: {
            type: String,
            required: true
        },
        keyName: {
            type: String,
            required: true
        },
        label: {
            type: Object,
            default() {
                return {
                    position: "left",
                    show: false,
                    text: ""
                };
            }
        },
        additionalOptionName: {
            type: Object,
            default() {
                return {
                    isShow: false,
                    optionName: ""
                };
            }
        },
        resetOption: {
            type: Object,
            default() {
                return {
                    isShow: false,
                    text: "",
                    isSendRequestAfterReset: false
                };
            }
        }
    },
    methods: {
        select(item) {
            if (this.mode === "Multiple") {
                this.selectInModeMultiple(item);
            } else if (this.mode === "Single") {
                this.selectInModeSingle(item);
            }
            this.sendEmit();
        },
        sendEmit() {
            this.$emit("selected", this.selected);
        },
        selectInModeMultiple(item) {
            const isSelected = this.isSelected(item[this.keyName]);
            if (isSelected) {
                this.selected.splice(
                    this.selected.indexOf(item[this.keyName]),
                    1
                );
                this.selectText.splice(
                    this.selectText.indexOf(item[this.optionName], 1)
                );
                return;
            }
            this.selected.push(item[this.keyName]);
            this.selectText.push(item[this.optionName]);
        },
        selectInModeSingle(item) {
            this.selected = item[this.keyName];
            this.selectText = item[this.optionName];
        },
        reset() {
            this.isMultipleMode
                ? this.resetInModeMultiple()
                : resetInModeSingle();
            this.sendEmit();
        },
        resetInModeMultiple() {
            this.selected = [];
            this.selectText = [];
        },
        resetInModeSingle() {
            this.selected = null;
            this.selectText = "";
        },
        switchSelect() {
            this.isActive = !this.isActive;
        },
        close() {
            this.isActive = false;
        },
        isSelected(key) {
            const candidate = this.selected.indexOf(key);
            if (candidate === -1) {
                return false;
            } else return true;
        }
    },
    computed: {
        positionLabelClass() {
            if (this.label.position === "left") {
                return "select_label__left";
            } else if (this.label.position === "top") {
                return "select_label__top";
            } else {
                return "";
            }
        },
        text() {
            if (this.selectText.length) {
                return `${this.selectText}`;
            }
            return "Выбрать";
        },
        isMultipleMode() {
            if (this.mode === "Multiple") {
                return true;
            }
            return false;
        }
    },
    mounted() {
        if (this.defaultValue.isActive) {
            if (!this.defaultValue.keys) {
                const defaultValue = this.data.find(
                    item => item[this.keyName] === this.defaultValue.key
                );
                if (defaultValue) this.select(defaultValue);
            } else {
                this.defaultValue.keys.forEach(key => {
                    const defaultValue = this.data.find(
                        item => item[this.keyName] === key
                    );
                    this.select(defaultValue);
                });
            }
        }
    }
};
</script>

<style lang="scss"></style>
