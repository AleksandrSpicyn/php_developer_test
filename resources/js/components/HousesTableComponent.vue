<template>
    <el-container>
        <el-header>
            <h2>Houses</h2>
        </el-header>
        <el-main>
            <el-form ref="houseFilter" :model="form" :inline="true">
                <el-form-item prop="name">
                    <el-input v-model="form.name" placeholder="Name" @input="onSubmit" @change="onSubmit"></el-input>
                </el-form-item>
                <el-form-item prop="min_price">
                    <el-input-number v-model.number="form.min_price" placeholder="Min. price" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item prop="max_price">
                    <el-input-number v-model.number="form.max_price" placeholder="Max. price" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item prop="bedrooms">
                    <el-input-number v-model.number="form.bedrooms" placeholder="Bedrooms" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item prop="bathrooms">
                    <el-input-number v-model.number="form.bathrooms" placeholder="Bathrooms" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item prop="storeys">
                    <el-input-number v-model.number="form.storeys" placeholder="Storeys" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item prop="garages">
                    <el-input-number v-model.number="form.garages" placeholder="Garages" :min=0
                                     @input="onSubmit" @change="onSubmit"></el-input-number>
                </el-form-item>
                <el-form-item>
                    <el-button @click="resetForm()">Reset</el-button>
                </el-form-item>
            </el-form>
            <el-table
                :data="tableData"
                stripe
                v-loading="loading"
                empty-text="Not found"
                style="width: 100%">
                <el-table-column
                    prop="name"
                    label="Name">
                </el-table-column>
                <el-table-column
                    prop="price"
                    label="Price">
                </el-table-column>
                <el-table-column
                    prop="bedrooms"
                    label="Bedrooms">
                </el-table-column>
                <el-table-column
                    prop="bathrooms"
                    label="Bathrooms">
                </el-table-column>
                <el-table-column
                    prop="storeys"
                    label="Storeys">
                </el-table-column>
                <el-table-column
                    prop="garages"
                    label="Garages">
                </el-table-column>
            </el-table>
            <div class="pagination">
                <el-pagination
                    background
                    @current-change="paginate"
                    :page-size="perPage"
                    layout="prev, pager, next"
                    :total="total">
                </el-pagination>
            </div>
        </el-main>
    </el-container>
</template>

<script>
export default {
    data() {
        return {
            tableData: [],
            form: {},
            timeout: null,
            loading: true,
            total: 0,
            perPage: 0,
        }
    },

    mounted() {
        this.getData()
    },

    methods: {
        getData() {
            this.loading = true;
            axios
                .get('/api/houses', {
                    params: this.form
                })
                .then(response => {
                    if (response.data.success) {
                        this.tableData = response.data.data.data
                        this.total = response.data.data.total
                        this.perPage = response.data.data.per_page
                    } else {
                        console.log(response.data.message)
                    }
                    this.loading = false
                })
                .catch(error => {
                    console.log(error.response)
                    this.loading = false
                });
        },
        onSubmit() {
            if (this.timeout) clearTimeout(this.timeout)
            this.timeout = setTimeout(() => {
                this.getData()
            }, 300)
        },
        paginate(page) {
            this.form.page = page
            this.getData()
        },
        resetForm() {
            this.$refs['houseFilter'].resetFields();
        }
    }
};
</script>

<style>
.el-header {
    padding-top: 1.5rem;
}

.pagination {
    justify-content: center;
    margin-top: 1rem;
}
</style>
