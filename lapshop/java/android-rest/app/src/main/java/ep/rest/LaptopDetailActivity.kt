package ep.rest

import android.app.AlertDialog
import android.content.Intent
import android.os.Bundle
import android.util.Log
import androidx.appcompat.app.AppCompatActivity
import ep.rest.databinding.ActivityLaptopDetailBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.IOException

class LaptopDetailActivity : AppCompatActivity() {
    private var laptop: Laptop = Laptop()
    val binding by lazy {
        ActivityLaptopDetailBinding.inflate(layoutInflater)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(binding.root)
        setSupportActionBar(binding.toolbar)


        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val id = intent.getIntExtra("ep.rest.id", 0)

        if (id > 0) {
            LaptopService.instance.get(id).enqueue(OnLoadCallbacks(this))
        }
    }

    private fun deleteBook(): Unit = TODO("Implementirajte izbris")

    private class OnLoadCallbacks(val activity: LaptopDetailActivity) : Callback<Laptop> {
        private val tag = this::class.java.canonicalName

        override fun onResponse(call: Call<Laptop>, response: Response<Laptop>) {
            activity.laptop = response.body() ?: Laptop()

            Log.i(tag, "Got result: ${activity.laptop}")

            if (response.isSuccessful) {
                activity.binding.includer.tvBookDetail.text = activity.laptop.item_desc
                activity.binding.toolbarLayout.title = activity.laptop.item_brand
            } else {
                val errorMessage = try {
                    "An error occurred: ${response.errorBody()?.string()}"
                } catch (e: IOException) {
                    "An error occurred: error while decoding the error message."
                }

                Log.e(tag, errorMessage)
                activity.binding.includer.tvBookDetail.text = errorMessage
            }
        }

        override fun onFailure(call: Call<Laptop>, t: Throwable) {
            Log.w(tag, "Error: ${t.message}", t)
        }
    }
}

