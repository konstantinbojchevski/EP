package ep.rest

import android.content.Intent
import android.os.Bundle
import android.util.Log
import androidx.appcompat.app.AppCompatActivity
import ep.rest.databinding.ActivityLaptopFormBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.IOException

class LaptopFormActivity : AppCompatActivity(), Callback<Void> {

    private var laptop: Laptop? = null

    private val binding by lazy {
        ActivityLaptopFormBinding.inflate(layoutInflater)
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(binding.root)

        binding.btnSave.setOnClickListener {
            val author = binding.etAuthor.text.toString().trim()
            val title = binding.etTitle.text.toString().trim()
            val description = binding.etDescription.text.toString().trim()
            val price = binding.etPrice.text.toString().trim().toDouble()

            if (laptop == null) { // dodajanje
                LaptopService.instance.insert(
                    author, title, price,
                    description
                ).enqueue(this)
            } else { // urejanje
                LaptopService.instance.update(
                    laptop!!.item_id, author, title, price,
                    description
                ).enqueue(this)
            }
        }

        val laptop = intent?.getSerializableExtra("ep.rest.book") as Laptop?
        if (laptop != null) {
            binding.etAuthor.setText(laptop.item_name)
            binding.etTitle.setText(laptop.item_brand)
            binding.etPrice.setText(laptop.item_price.toString())
            binding.etDescription.setText(laptop.item_desc)
            this.laptop = laptop
        }
    }

    override fun onResponse(call: Call<Void>, response: Response<Void>) {
        val headers = response.headers()

        if (response.isSuccessful) {
            val id = if (laptop == null) {
                // Preberemo Location iz zaglavja
                Log.i(TAG, "Insertion completed.")
                val parts =
                    headers.get("Location")?.split("/".toRegex())?.dropLastWhile { it.isEmpty() }
                        ?.toTypedArray()
                // spremenljivka id dobi vrednost, ki jo vrne zadnji izraz v bloku
                parts?.get(parts.size - 1)?.toInt()
            } else {
                Log.i(TAG, "Editing saved.")
                // spremenljivka id dobi vrednost, ki jo vrne zadnji izraz v bloku
                laptop!!.item_id
            }

            val intent = Intent(this, LaptopDetailActivity::class.java)
            intent.putExtra("ep.rest.id", id)
            startActivity(intent)
        } else {
            val errorMessage = try {
                "An error occurred: ${response.errorBody()?.string()}"
            } catch (e: IOException) {
                "An error occurred: error while decoding the error message."
            }

            Log.e(TAG, errorMessage)
        }
    }

    override fun onFailure(call: Call<Void>, t: Throwable) {
        Log.w(TAG, "Error: ${t.message}", t)
    }

    companion object {
        private val TAG = LaptopFormActivity::class.java.canonicalName
    }
}
