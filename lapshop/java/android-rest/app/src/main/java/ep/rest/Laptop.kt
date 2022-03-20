package ep.rest

import java.io.Serializable

data class Laptop(
        val item_id: Int = 0,
        val item_brand: String = "",
        val item_name: String = "",
        val item_desc: String = "",
        val item_price: Double = 0.0) : Serializable
