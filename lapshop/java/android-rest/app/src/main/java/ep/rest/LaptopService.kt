package ep.rest

import retrofit2.Call
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import retrofit2.http.*

object LaptopService {

    interface RestApi {

        companion object {
            // AVD emulator
             const val URL = "http://10.0.2.2:8080/netbeans/lapshop-rest/api/"
            // Genymotion
            //const val URL = "http://10.0.3.2:8080/netbeans/mvc-rest/api/"
        }

        @GET("laptops")
        fun getAll(): Call<List<Laptop>>

        @GET("laptops/{id}")
        fun get(@Path("id") item_id: Int): Call<Laptop>

        @FormUrlEncoded
        @POST("books")
        fun insert(@Field("author") author: String,
                   @Field("title") title: String,
                   @Field("price") price: Double,
                   @Field("description") description: String): Call<Void>

        @FormUrlEncoded
        @PUT("books/{id}")
        fun update(@Path("id") id: Int,
                   @Field("author") author: String,
                   @Field("title") title: String,
                   @Field("price") price: Double,
                   @Field("description") description: String): Call<Void>
    }

    val instance: RestApi by lazy {
        val retrofit = Retrofit.Builder()
                .baseUrl(RestApi.URL)
                .addConverterFactory(GsonConverterFactory.create())
                .build()

        retrofit.create(RestApi::class.java)
    }
}
