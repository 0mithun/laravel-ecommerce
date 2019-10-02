<template>
  <div>
    <div class="tile">
        <h3 class="tile-title">Attributes</h3>
        <hr>
        <div class="tile-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="parent">Select an attributes <span class="m-l-5 text-danger">*</span></label>
                        <select id="parent" class="form-control custom-select mt-15" v-model="attribute" @change="selectAttribute(attribute)">
                            <option :value="attribute" v-for="(attribute, index) in attributes" :key="index">{{ attribute.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tile" v-if="attributeSelected">
        <h3 class="tile-title">Add Attributes To Product</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="values">Select an value <span class="m-l-5 text-danger">*</span></label>
                    <select id="values" class="form-control custom-select mt-5" v-model="value" @change="selectValue(value)">
                        <option :value="value" v-for="(value, index) in attributeValues" :key="index">{{ value.value }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" v-if="valueSelected">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="quantity" class="control-label">Quantity</label>
                    <input type="number" id="quantity" class="form-control" v-model="currentQty">
                </div>
            </div>
            <div class="col-md-4">
                <label for="price" class="control-label">Price</label>
                <input type="text" class="form-control" id="price" v-model="currentPrice">
                <small class="text-danger">This price will be added to the main price of product on frontend</small>
            </div>
            <div class="col-md-12">
                <button class="btn btn-sm btn-primary" @click="addProductAttribute"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="tile">
          <h3 class="tile-title">
              Product Attributes
          </h3>

        <div class="tile-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>Value</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(pa, index) in productAttributes" :key="index">
                            <td style="width:25%" class="text-center">{{ pa.value }}</td>
                            <td style="width:25%" class="text-center">{{ pa.quantity }}</td>
                            <td style="width:25%" class="text-center">{{ pa.price }}</td>
                            <td style="width:25%" class="text-center">
                                <button class="btn btn-sm btn-danger" @click="deleteProductAttribute(pa)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  </div>
</template>

<script>
export default {
    props:['productid'],
    data(){
        return{
            productAttributes:[],
            attributes:[],
            attribute:{},
            attributeSelected:false,
            attributeValues:[],
            value:{},
            valueSelected:false,
            currentAttributeId:'',
            currentValue:'',
            currentQty:'',
            currentPrice:''
        }
    },
    created(){
        this.loadAttributes();
        this.loadProductAttributes(this.productid)
    },
    methods:{
        loadProductAttributes(id){
            axios.post('/admin/products/attributes',{id:id})
            .then((result) => {
                this.productAttributes = result.data
                console.log(result);
            }).catch((err) => {
                console.log(err)
            });
        },
        loadAttributes(){
            axios.get('/admin/products/attributes/load')
            .then((result) => {
                this.attributes = result.data
            }).catch((err) => {
                console.log(err)
            });
        },
        selectAttribute(attribute){
            this.currentAttributeId = attribute.id
            axios.post('/admin/products/attributes/values',{id:attribute.id})
            .then((result) => {
                this.attributeValues = result.data
            }).catch((err) => {
                console.log(err)
            });

            this.attributeSelected = true
        },

        selectValue(value){
            this.valueSelected = true
            this.currentValue = value.value
            this.currentQty = value.quantity
            this.currentValue = value.price

        },

        addProductAttribute(){
            if(this.currentQty === null || this.currentPrice ===null){
                this.$swal("Error, Some values are missing",{
                    icon:'error'
                })
            }else{
                let data={
                    attribute_id: this.currentAttributeId,
                    value : this.currentValue,
                    quantity : this.currentQty,
                    price : this.currentPrice,
                    product_id : this.productid
                }

                axios.post('/admin/products/attributes/add',{data:data})
                .then((result) => {
                    this.$swal('Success '+ result.data.message,{icon:'success'})
                    this.currentPrice= ''
                    this.currentValue=''
                    this.currentQty=''
                    this.valueSelected = false

                }).catch((err) => {
                    console.log(err)
                });

                this.loadProductAttributes(this.productid)
            }
        },
        deleteProductAttribute(pa){
            this.$swal(
                {
                    title:"Are you sure?",
                    text:'Once deleted, you will not be able to recover this data!',
                    icon:'warning',
                    buttons:true,
                    dangerMode: true
                }
            ).then((willDelete) => {
                if(willDelete){
                    console.log(pa.id)
                    axios.post('/admin/products/attributes/delete',{id: pa.id})
                    .then((result) => {
                        if(result.data.status == 'success'){
                            this.$swal('Success! Product attribute has been deleted!',{icon:'success'})
                            this.loadProductAttributes(this.productid)
                        }else{
                            this.$swal('Your Product attribute not deleted!')
                        }

                    }).catch((err) => {
                        console.log(err)
                    });
                }else{
                    this.$swal('Action cancelled!')
                }
            })
        }
    }
}
</script>
